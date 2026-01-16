<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Job;
use App\Models\Report;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Exports\JobSeekersExport;
use App\Models\FollowingEmployer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getFeaturedData(Request $request)
    {
        $account_id = Auth::id();
        $seeker = JobSeeker::where('account_id', $account_id)->firstOrFail();
        $search_text = $request->search;
        $job_type = $request->job_type;
        $location = $request->location;
        $isInitial = filter_var($request->input('initial'), FILTER_VALIDATE_BOOLEAN);
        $jobType = JobType::where('seeker_id', $seeker->seeker_id)->pluck('job_type')->toArray();

        $approvedEmployerAccountIds = Accounts::where('is_approved', 1)
            ->where('user_type', 'employer')
            ->pluck('account_id');

        $employersQuery = Employer::with('account')
            ->whereIn('account_id', $approvedEmployerAccountIds);

        $jobsQuery = Job::with(['employer', 'jobTypes'])
            ->where('status', 'accepted')
            ->where('is_available', 1);

        if ($isInitial) {
            if (!empty($jobType)) {
                $employersQuery->whereHas('jobTypes', function ($q) use ($jobType) {
                    $q->whereIn('job_type', $jobType);
                });
                $jobsQuery->whereHas('jobTypes', function ($q) use ($jobType) {
                    $q->whereIn('job_type', $jobType);
                });
            }
        }

        if (!empty($job_type) && $job_type !== "all_job_type") {
            $filterJobTypes = is_array($job_type) ? $job_type : [$job_type];
            $employersQuery->whereHas('jobTypes', function ($q) use ($filterJobTypes) {
                $q->whereIn('job_type', $filterJobTypes);
            });
            $jobsQuery->whereHas('jobTypes', function ($q) use ($filterJobTypes) {
                $q->whereIn('job_type', $filterJobTypes);
            });
        }

        if (!empty($location) && $location !== "all_location") {
            $employersQuery->where('barangay', $location);
            $jobsQuery->where('location', "Brgy. $location, Borongan City");
        }

        if (!empty($search_text)) {
            $employersQuery->where(function ($q) use ($search_text) {
                $q->where('comp_name', 'like', "%{$search_text}%")
                    ->orWhere('first_name', 'like', '%' . $search_text . '%')
                    ->orWhere('last_name', 'like', '%' . $search_text . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search_text}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search_text}%");
            });

            $jobsQuery->where(function ($q) use ($search_text) {
                $q->where('title', 'like', "%{$search_text}%");
            });
        }

        $employersQuery->orderBy('created_at', 'asc');

        $jobsQuery->orderByDesc('created_at');

        $employers = $employersQuery->get();
        $jobs = $jobsQuery->get();

        return response()->json([
            'success' => true,
            'employers' => $employers,
            'jobs' => $jobs,
        ]);
    }

    //------------------------------- EMPLOYER FUNCTIONALITY ------------------------------

    //view employer
    public function viewEmployer($employer_id)
    {
        $employer = Employer::where('employer_id', $employer_id)->first();

        if (!$employer || !$employer->account || $employer->account->is_approved != 1) {
            return response()->json([
                'success' => false,
                'message' => 'This employer is restricted or not an approved account by the admin.',
            ]);
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $employer,
            ]);
        }

        return view('design.seeker.view-employer', compact('employer'));
    }

    //get employer data
    public function getEmployerData(Request $request)
    {
        $employer_id = $request->input('employer_id');

        if (empty($employer_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Employer ID is required.',
            ], 400);
        }

        $employer = Employer::with('account')->where('employer_id', $employer_id)->first();
        $job_type = JobType::where('employer_id', $employer_id)->value('job_type');

        if (!$employer) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $employer,
            'job_type' => $job_type,
        ]);
    }

    //get all posted and available jobs
    public function getPostedJobs(Request $request)
    {
        $employer_id = $request->input('employer_id');

        if (empty($employer_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Employer ID is required.',
            ], 400);
        }

        $jobs = Job::with(['employer', 'jobTypes' => function ($qry) {
            $qry->select('job_id', 'job_type');
        }])->where('employer_id', $employer_id)
            ->where('status', 'accepted')
            ->where('is_available', 1)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    //check is following
    public function isFollowing(Request $request)
    {
        $employer_id = $request->employer_id;
        $account_id = Auth::id();
        $seeker = JobSeeker::where('account_id', $account_id)->first();

        $existing = FollowingEmployer::where('employer_id', $employer_id)
            ->where('seeker_id', $seeker->seeker_id)
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
        $employer_id = $request->employer_id;
        $employer_account_id = Employer::where('employer_id', $employer_id)->value('account_id');
        $account_id = Auth::id();
        $seeker = JobSeeker::where('account_id', $account_id)->first();

        if (!$seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Job Seeker not found.',
            ], 404);
        }

        $notif_title = 'New Follow';
        $notif_content = 'You have been followed by ' . $seeker->first_name . ' ' . ($seeker->mid_name ?? '') . ' ' . $seeker->last_name . ' ' . ($seeker->suffix ?? '') .  '.';

        $existing = FollowingEmployer::where('employer_id', $employer_id)
            ->where('seeker_id', $seeker->seeker_id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            FollowingEmployer::create([
                'seeker_id' => $seeker->seeker_id,
                'employer_id' => $employer_id,
                'followed_at' => now(),
            ]);

            Notification::create([
                'sender_id' => $account_id,
                'sender_role' => 'job_seeker',
                'receiver_id' => $employer_account_id,
                'receiver_role' => 'employer',
                'notif_title' => $notif_title,
                'notif_content' => $notif_content,
                'recieved_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    // Report a employer
    public function reportEmployer(Request $request)
    {
        $employer_id = $request->input('employer_id');
        $employer_account_id = Employer::where('employer_id', $employer_id)->value('account_id');
        $title = $request->input('title');

        if (empty($title)) {
            return response()->json([
                'success' => false,
                'message' => "Please select a report category.",
            ]);
        }

        if (!$employer_id) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.',
            ]);
        }

        $find_employer = Employer::find($employer_id);
        if (!$find_employer) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.',
            ]);
        }

        if ($find_employer->is_reported == "1") {
            return response()->json([
                'success' => false,
                'message' => 'This employer has already been reported. Thank you for your concern.',
            ]);
        }

        $report = Report::create([
            'employer_id' => $employer_id,
            'report_title' => $title,
            'reported_at' => now(),
        ]);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Could not process the request. Please try again.',
            ]);
        }

        $find_employer->is_reported = 1;
        $find_employer->save();

        $notif_title = 'Account Notice';
        $notif_content = "Your account has been reported for the following reason: \"$title\".";

        Notification::create([
            'sender_id' => 1,
            'sender_role' => 'admin',
            'receiver_id' => $employer_account_id,
            'receiver_role' => 'employer',
            'notif_title' => $notif_title,
            'notif_content' => $notif_content,
            'recieved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Report was sent successfully. Thank you for your cooperation.",
        ]);
    }


    //------------------------------- JOB FUNCTIONALITY ------------------------------

    //view job
    public function viewJob($job_id)
    {
        $job = Job::where('job_id', $job_id)->first();

        return view('design.seeker.view-job', compact('job'));
    }

    //get job data
    public function getJobData(Request $request)
    {
        $job_id = $request->job_id;
        $job = Job::with('employer')->where('job_id', $job_id)->firstOrFail();
        $job_type = JobType::where('job_id', $job_id)->value('job_type');

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve job data.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
            'job_type' => $job_type,
        ]);
    }

    //get related jobs
    public function getRelatedJobs(Request $request)
    {
        $job_type = $request->job_type;
        $job_id = $request->job_id;

        $jobs = Job::with(['employer', 'jobTypes' => function ($type) use ($job_type) {
            $type->where('job_type', $job_type);
        }])->where('job_id', '!=', $job_id)
            ->limit(10)
            ->get();

        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve related jobs.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    //check application status for the job
    public function checkApplicationStatus(Request $request)
    {
        $account_id = Auth::id();
        $seeker = JobSeeker::where('account_id', $account_id)->first();
        $job_id = $request->job_id;

        if (!$seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Job seeker not found.',
            ]);
        }

        $applied = AppliedJob::where('seeker_id', $seeker->seeker_id)
            ->where('job_id', $job_id)
            ->first();

        if (!$applied) {
            return response()->json([
                'success' => true,
                'applied' => false,
                'status' => null,
                'message' => 'Havent applied yet',
            ]);
        }

        return response()->json([
            'success' => true,
            'applied' => true,
            'status' => $applied->status,
            'message' => 'Already applied',
        ]);
    }

    //apply for the job
    public function applyJob(Request $request)
    {
        $job_id = $request->job_id;
        $employer_id = $request->employer_id;

        $job = Job::where('job_id', $job_id)->first();
        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.',
            ], 404);
        }

        $employer = Employer::where('employer_id', $employer_id)->first();
        if (!$employer) {
            return response()->json([
                'success' => false,
                'message' => 'Employer not found.',
            ], 404);
        }

        $employer_account_id = $employer->account_id;
        $account_id = Auth::id();
        $seeker = JobSeeker::where('account_id', $account_id)->first();

        if (!$seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Job Seeker not found.',
            ], 404);
        }

        $mid_name = $seeker->mid_name ?? '';
        $suffix = $seeker->suffix ?? '';

        $notif_title = 'Job Application';
        $notif_content = trim("{$seeker->first_name} {$mid_name} {$seeker->last_name} {$suffix}") . " applied to your job posting for {$job->title}.";

        $applied = AppliedJob::create([
            'seeker_id'   => $seeker->seeker_id,
            'employer_id' => $employer_id,
            'job_id'      => $job->job_id,
            'applied_at'  => now(),
        ]);

        $notification = Notification::create([
            'sender_id'     => $account_id,
            'sender_role'   => 'job_seeker',
            'receiver_id'   => $employer_account_id,
            'receiver_role' => 'employer',
            'notif_title'   => $notif_title,
            'notif_content' => $notif_content,
            'recieved_at'   => now(),
        ]);

        if (!$applied || !$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Could not process your request.',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Your application was successfully sent to the employer.',
        ]);
    }

    // Report a job
    public function reportJob(Request $request)
    {
        $job_id = $request->input('job_id');
        $job_title = Job::where('job_id', $job_id)->value('title');
        $employer_id = Job::where('job_id', $job_id)->value('employer_id');
        $employer_account_id = Employer::where('employer_id', $employer_id)->value('account_id');
        $title = $request->input('title');

        if (empty($title)) {
            return response()->json([
                'success' => false,
                'message' => "Please select a report category.",
            ]);
        }

        if (!$job_id) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.',
            ]);
        }

        $job = Job::find($job_id);
        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.',
            ]);
        }

        if ($job->is_reported) {
            return response()->json([
                'success' => false,
                'message' => 'This job has already been reported. Thank you for your concern.',
            ]);
        }

        $report = Report::create([
            'job_id' => $job_id,
            'report_title' => $title,
            'reported_at' => now(),
        ]);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Could not process the request. Please try again.',
            ]);
        }

        $job->is_reported = 1;
        $job->save();

        $notif_title = 'Account Notice';
        $notif_content = "Your job \"$job_title\" has been reported for the following reason: \"$title\".";

        Notification::create([
            'sender_id' => 1,
            'sender_role' => 'admin',
            'receiver_id' => $employer_account_id,
            'receiver_role' => 'employer',
            'notif_title' => $notif_title,
            'notif_content' => $notif_content,
            'recieved_at' => now(),
        ]);


        return response()->json([
            'success' => true,
            'message' => "Report was sent successfully. Thank you for your cooperation.",
        ]);
    }
}
