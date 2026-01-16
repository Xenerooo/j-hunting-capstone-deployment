<?php

namespace App\Http\Controllers\Employer;

use App\Models\Job;
use App\Models\Report;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FollowingJobSeeker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //get summary data
    public function summary()
    {
        $account_id = Auth::id();
        $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

        $posted_jobs = Job::where('employer_id', $employer_id)->where('status', 'accepted')->count();
        $applicants = AppliedJob::where('employer_id', $employer_id)->count();
        $notifications = Notification::where('receiver_id', $account_id)->where('receiver_role', 'employer')->count();

        return response()->json([
            'success' => true,
            'posted_jobs' => $posted_jobs,
            'applicants' => $applicants,
            'notifications' => $notifications,
        ]);
    }

    //get job seekers
    public function getJobSeekers(Request $request)
    {
        $account_id = Auth::id();
        $employer = Employer::where('account_id', $account_id)->firstOrFail();
        $employer_job_type = JobType::where('employer_id', $employer->employer_id)->value('job_type');

        $searchText = $request->searchText;
        $selectedJobType = $request->jobType;
        $location = $request->location;

        $approvedAccountIds = Accounts::where('is_approved', 1)
            ->where('user_type', 'job_seeker')
            ->pluck('account_id');

        $query = JobSeeker::with(['account', 'jobTypes' => function ($qry) {
            $qry->select('seeker_id', 'job_type');
        }])->whereIn('account_id', $approvedAccountIds);

        if (isset($searchText) && $searchText !== '') {
            $query->where(function ($q) use ($searchText) {
                $q->where('first_name', 'like', "%{$searchText}%")
                    ->orWhere('mid_name', 'like', "%{$searchText}%")
                    ->orWhere('last_name', 'like', "%{$searchText}%")
                    ->orWhere(DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'like', "%{$searchText}%")
                    ->orWhere(DB::raw("CONCAT_WS(' ', first_name, mid_name, last_name)"), 'like', "%{$searchText}%");
            });
        }

        if (!empty($selectedJobType) && $selectedJobType != "all_job_type") {
            $query->whereHas('jobTypes', function ($q) use ($selectedJobType) {
                $q->where('job_type', $selectedJobType);
            });
        } elseif (empty($selectedJobType) && empty($searchText)) {
            if (!empty($employer_job_type)) {
                $query->whereHas('jobTypes', function ($q) use ($employer_job_type) {
                    $q->where('job_type', $employer_job_type);
                });
            }
        }

        if (isset($location) && $location != "all_location") {
            $query->where('barangay', $location)->orderBy('created_at', 'asc');
        }

        $result = $query->orderBy('created_at', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    //view job seeker
    public function viewJobSeeker($seeker_id)
    {
        $jobSeeker = JobSeeker::where('seeker_id', $seeker_id)->first();

        return view('design.employer.view-seeker', compact('jobSeeker'));
    }

    //get job seeker data
    public function getProfileData(Request $request)
    {
        $employer_id = Auth::id();
        $seeker_id = $request->input('seeker_id');
        $seeker = JobSeeker::with('account', 'portfolio')->where('seeker_id', $seeker_id)->firstOrFail();
        $job_type = JobType::where('seeker_id', $seeker_id)->pluck('job_type');
        $is_followed = FollowingJobSeeker::where('seeker_id', $seeker_id)->where('employer_id', $employer_id)->first();

        return response()->json([
            'success' => true,
            'data' => $seeker,
            'job_type' => $job_type,
            'is_followed' => $is_followed ? true : false,
            'portfolio' => $seeker->portfolio->map(function ($portfolio) {
                return [
                    'type' => $portfolio->type,
                    'path' => $portfolio->path,
                ];
            }),
        ]);
    }

    //check is following
    public function isFollowing(Request $request)
    {
        $seeker_id = $request->seeker_id;
        $account_id = Auth::id();
        $employer = Employer::where('account_id', $account_id)->first();

        $existing = FollowingJobSeeker::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer->employer_id)
            ->exists();

        if (!$existing) {
            return response()->json([
                'text' => 'Follow',
            ]);
        }

        return response()->json([
            'text' => 'Unfollow',
        ]);
    }

    //follow job seeker
    public function followSeeker(Request $request)
    {
        $seeker_id = $request->seeker_id;
        $seeker_account_id = JobSeeker::where('seeker_id', $seeker_id)->value('account_id');
        $account_id = Auth::id();
        $employer = Employer::where('account_id', $account_id)->first();

        if (!$employer) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.',
            ], 404);
        }

        $notif_title = 'New Follow';
        $notif_content = 'You have been followed by ' . $employer->first_name . ' ' . ($employer->mid_name ?? '') . ' ' . $employer->last_name . ' ' . ($employer->suffix ?? '') .  '.';

        $existing = FollowingJobSeeker::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer->employer_id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            FollowingJobSeeker::create([
                'seeker_id' => $seeker_id,
                'employer_id' => $employer->employer_id,
                'followed_at' => now(),
            ]);

            Notification::create([
                'sender_id' => $account_id,
                'sender_role' => 'employer',
                'receiver_id' => $seeker_account_id,
                'receiver_role' => 'job_seeker',
                'notif_title' => $notif_title,
                'notif_content' => $notif_content,
                'recieved_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    // Report a job seeker
    public function reportSeeker(Request $request)
    {
        $seeker_id = $request->input('seeker_id');
        $seeker_account_id = JobSeeker::where('seeker_id', $seeker_id)->value('account_id');
        $title = $request->input('title');

        if (empty($title)) {
            return response()->json([
                'success' => false,
                'message' => "Please select a report category.",
            ]);
        }

        if (!$seeker_id) {
            return response()->json([
                'success' => false,
                'message' => 'Job seeker not found.',
            ]);
        }

        $find_seeker = JobSeeker::find($seeker_id);
        if (!$find_seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Job seeker not found.',
            ]);
        }

        if ($find_seeker->is_reported == "1") {
            return response()->json([
                'success' => false,
                'message' => 'This job seeker has already been reported. Thank you for your concern.',
            ]);
        }

        $report = Report::create([
            'seeker_id' => $seeker_id,
            'report_title' => $title,
            'reported_at' => now(),
        ]);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Could not process the request. Please try again.',
            ]);
        }

        $find_seeker->is_reported = 1;
        $find_seeker->save();

        $notif_title = 'Account Notice';
        $notif_content = "Your account has been reported for the following reason: \"$title\".";

        Notification::create([
            'sender_id' => 1,
            'sender_role' => 'admin',
            'receiver_id' => $seeker_account_id,
            'receiver_role' => 'job_seeker',
            'notif_title' => $notif_title,
            'notif_content' => $notif_content,
            'received_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Report was sent successfully. Thank you for your cooperation.",
            'report' => $report,
        ]);
    }
}
