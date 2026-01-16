<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FollowingEmployer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestJobController extends Controller
{
    //show all job request
    public function show(Request $request)
    {
        $query = Job::with(['employer', 'jobTypes' => function ($qry) {
            $qry->select('job_id', 'job_type');
        }])->whereIn('status', ['pending', 'restricted']);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('employer', function ($q2) use ($search) {
                        $q2->where('comp_name', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'newest') {
                $query->orderByDesc('created_at');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('created_at');
            } else {
                $query->orderByDesc('created_at');
            }
        }

        $jobs = $query->get();

        if ($jobs->isEmpty()) {
            return response()->json([
                'message' => 'No job request found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Request jobs found.',
            'data' => $jobs,
        ]);
    }

    //view job data
    public function view($job_id)
    {
        $job = Job::where('job_id', $job_id)->firstOrFail();

        return view('design.admin.view-requested-job', compact('job'));
    }

    //get job data
    public function getJobData(Request $request)
    {
        $jobID = $request->job_id;

        $job = Job::with('employer')->where('job_id', $jobID)->firstOrFail();
        $job_types = JobType::where('job_id', $jobID)->pluck('job_type');

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
            'job_types' => $job_types,
        ]);
    }

    //sending notification and email to employer and approval of account
    public function approval(Request $request)
    {
        $sender_id = Auth::id();
        $employer = Employer::where('employer_id', $request->employer_id)->firstOrFail();
        $notif_title = "";
        $notif_content = "";
        $receiver_role = "employer";
        $sender_role = "admin";

        $all_account_id = JobSeeker::whereIn(
            'seeker_id',
            FollowingEmployer::where('employer_id', $employer->employer_id)
                ->where('get_notified', 1)
                ->pluck('seeker_id')
        )
            ->pluck('account_id')
            ->toArray();

        $isApproved = ($request->is_approved === true || $request->is_approved === "true");

        if ($isApproved) {
            $notif_title = $request->title;
            $notif_content = $request->content;

            $notif_user_title = "Exciting Opportunity Alert!";
            $notif_user_content = "Great news! $employer->first_name $employer->last_name just posted a brand new job \"{$request->job_title}\". Check it out and be among the first to apply!";

            foreach ($all_account_id as $receiver_id) {
                Notification::create([
                    'sender_id' => $employer->account_id,
                    'sender_role' => 'employer',
                    'receiver_id' => $receiver_id,
                    'receiver_role' => 'job_seeker',
                    'notif_title' => $notif_user_title,
                    'notif_content' => $notif_user_content,
                    'received_at' => now(),
                ]);
            }
        } else {
            $notif_title = $request->title;
            $notif_content = $request->content;
        }

        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $employer->account_id,
            'notif_title' => $notif_title,
            'notif_content' => $notif_content,
            'receiver_role' => $receiver_role,
            'sender_role' => $sender_role,
            'received_at' => Carbon::now(),
        ];

        $notification = Notification::create($data);

        if (!$notification) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Notification and email not sent.'
                ]
            );
        }

        $jobID = $request->job_id;

        if ($isApproved) {
            Job::where('job_id', $jobID)->update(['status' => 'accepted', 'is_available' => 1]);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job approved successfully.',
                    'is_approved' => $request->is_approved,
                ]
            );
        } else {
            Job::where('job_id', $jobID)->update(['status' => 'rejected', 'is_available' => 0]);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job declined successfully.',
                    'is_approved' => $request->is_approved,
                ]
            );
        }
    }
}
