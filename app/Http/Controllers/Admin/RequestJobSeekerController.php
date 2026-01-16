<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\JobSeeker;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AccountApprovalNotification;

class RequestJobSeekerController extends Controller
{
    //show all job seeker request
    public function show(Request $request)
    {
        $seekerID = Accounts::where('user_type', 'job_seeker')
            ->where('is_approved', 0)
            ->pluck('account_id')
            ->toArray();

        if (empty($seekerID)) {
            return response()->json([
                'message' => 'No job seeker request found.',
            ]);
        }

        $query = JobSeeker::with(['account', 'jobTypes' => function ($qry) {
            $qry->select('seeker_id', 'job_type');
        }])->whereIn('account_id', $seekerID)->whereNotNull('seeker_id');

        // search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
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
            } else {
                $query->orderByDesc('created_at');
            }
        }

        $results = $query->get()->all();

        return response()->json([
            'message' => 'Request job seekers found.',
            'data' => $results,
        ]);
    }

    //view profile data of job seeker
    public function view($seeker_id)
    {
        $seeker = JobSeeker::where('seeker_id', $seeker_id)->firstOrFail();

        return view('design.admin.view-requested-seeker', compact('seeker'));
    }

    //get profile data of job seeker
    public function getProfileData(Request $request)
    {
        $seekerID = $request->seeker_id;

        $seeker = JobSeeker::with('account', 'portfolio')->where('seeker_id', $seekerID)->firstOrFail();
        $job_types = JobType::where('seeker_id', $seekerID)->pluck('job_type');

        if (!$seeker) {
            return response()->json(['success' => false, 'message' => 'Job seeker not found.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $seeker,
            'portfolio' => $seeker->portfolio->map(function ($portfolio) {
                return [
                    'type' => $portfolio->type,
                    'path' => $portfolio->path,
                ];
            }),
            'job_types' => $job_types,
        ]);
    }

    //sending notification and email to job seeker and approval of account
    public function approval(Request $request)
    {
        $user_email = $request->email;
        $sender_id = Auth::id();
        $receiver_id = JobSeeker::where('seeker_id', $request->seeker_id)->value('account_id');
        $notif_title = "";
        $notif_content = "";
        $receiver_role = "job_seeker";
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
            'receiver_id' => $receiver_id,
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
            $updated = Accounts::where('account_id', $receiver_id)->update(['is_approved' => 1]);

            if (!$updated) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'An error occured while processing...',
                        'is_approved' => $request->is_approved,
                        'is_updated' => $updated,
                        'account_id' => $receiver_id
                    ]
                );
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
