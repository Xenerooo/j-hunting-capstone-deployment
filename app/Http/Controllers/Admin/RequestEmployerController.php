<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Accounts;
use App\Models\Employer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AccountApprovalNotification;
use App\Models\JobType;

class RequestEmployerController extends Controller
{
    //show all employer request
    public function show(Request $request)
    {
        $employerID = Accounts::where('user_type', 'employer')
            ->where('is_approved', 0)
            ->pluck('account_id')
            ->toArray();

        if (empty($employerID)) {
            return response()->json([
                'message' => 'No employer request found.',
            ]);
        }

        $query = Employer::whereIn('account_id', $employerID)->whereNotNull('employer_id');

        // search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('job_type', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('comp_name', 'like', '%' . $search . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        // sort
        if ($request->filled('sort')) {
            if ($request->sort === 'newest') {
                $query->orderByDesc('created_at');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('created_at');
            }
        }

        $results = $query->get()->all();

        return response()->json([
            'message' => 'Request employers found.',
            'data' => $results,
        ]);
    }

    //view profile data of employer
    public function view($employer_id)
    {
        $employer = Employer::where('employer_id', $employer_id)->firstOrFail();

        return view('design.admin.view-requested-employer', compact('employer'));
    }

    //get profile data of employer
    public function getProfileData(Request $request)
    {
        $employerID = $request->employer_id;

        $employer = Employer::with('account')->where('employer_id', $employerID)->firstOrFail();
        $job_type = JobType::where('employer_id', $employer->employer_id)->value('job_type');

        if (!$employer) {
            return response()->json(['success' => false, 'message' => 'Employer not found.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $employer,
            'job_type' => $job_type,
        ]);
    }

    //sending notification and email to employer and approval of account
    public function approval(Request $request)
    {
        $user_email = $request->email;
        $sender_id = Auth::id();
        $receiver_id = Employer::where('employer_id', $request->employer_id)->firstOrFail();
        $notif_title = "";
        $notif_content = "";
        $receiver_role = "employer";
        $sender_role = "admin";

        if (!$request->is_approved) {
            $notif_title = $request->title;
            $notif_content = $request->content;
        } else {
            $notif_title = $request->title;
            $notif_content = $request->content;
        }

        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id->account_id,
            'notif_title' => $notif_title,
            'notif_content' => $notif_content,
            'receiver_role' => $receiver_role,
            'sender_role' => $sender_role,
            'received_at' => Carbon::now(),
        ];

        $notification = Notification::create($data);
        $mail = Mail::to($user_email)->send(new AccountApprovalNotification($notif_title, $notif_content));

        if (!$notification && !$mail) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Notification and email not sent.'
                ]
            );
        }

        //approved account
        if ($request->is_approved === "true") {
            $accountID = $receiver_id->account_id;
            Accounts::where('account_id', $accountID)->update(['is_approved' => 1]);

            $employer_id = $request->employer_id;
            if (Job::where('employer_id', $employer_id)->exists()) {
                Job::where('employer_id', $employer_id)
                    ->where('status', 'accepted')
                    ->whereColumn('max_applicant', '>', 'hired_applicant')
                    ->update(['is_available' => 1]);
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Email sent and account approved successfully.',
                    'is_approved' => $request->is_approved,
                ]
            );
        }

        //declined account
        return response()->json(
            [
                'success' => true,
                'message' => 'Email sent and account declined successfully.',
                'is_approved' => $request->is_approved,
            ]
        );
    }
}
