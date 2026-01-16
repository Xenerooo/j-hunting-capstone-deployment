<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\JobSeekersExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Admin\RestrictUserMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AllJobSeekerController extends Controller
{
    //get all job seeker
    public function getAllJobSeeker(Request $request)
    {
        $approvedAccountIds = Accounts::where('is_approved', 1)
            ->where('user_type', 'job_seeker')
            ->pluck('account_id');

        $query = JobSeeker::with(['account', 'jobTypes' => function ($qry) {
            $qry->select('seeker_id', 'job_type');
        }])->whereIn('account_id', $approvedAccountIds);


        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('mid_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $sortBy = $request->input('sort');
            switch ($sortBy) {
                case 'newest':
                    $query->orderByDesc('created_at');
                    break;
                case 'oldest':
                    $query->orderBy('created_at');
                    break;
                case 'active':
                    $query->whereHas('account', fn($q) => $q->where('is_active', 1));
                    break;
                case 'inactive':
                    $query->whereHas('account', fn($q) => $q->where('is_active', 0));
                    break;
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        }

        $results = $query->get();

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }

    //download all job seeker
    public function download(Request $request)
    {
        $month = $request->input('month', date('F'));
        $year = $request->input('year', date('Y'));
        $sort = $request->input('sort', 'all');

        return Excel::download(new JobSeekersExport($month, $year, $sort), "job_seekers_{$month}_{$year}.xlsx");
    }

    //view job seeker
    public function view($seeker_id)
    {
        $seeker = JobSeeker::where('seeker_id', $seeker_id)->firstOrFail();
        return view('design.admin.view-seeker', compact('seeker'));
    }

    //get profile data of job seeker
    public function getProfileData(Request $request)
    {
        $seeker_id = $request->input('seeker_id');
        $seeker = JobSeeker::with('account', 'portfolio')->where('seeker_id', $seeker_id)->firstOrFail();
        $job_types = JobType::where('seeker_id', $seeker_id)->pluck('job_type');

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

    //send message to the user
    public function sendMessage(Request $request)
    {
        $sender_id = Auth::id();

        $seeker_id = $request->input('seeker_id');
        $seeker = JobSeeker::where('seeker_id', $seeker_id)->firstOrFail();
        $title = $request->input('title');
        $content = $request->input('content');

        if ($request->input('is_warning') === "true") {

            $request->validate([
                'title' => ['required'],
                'content' => ['required']
            ]);

            $notification = Notification::create([
                'sender_id' => $sender_id,
                'receiver_id' => $seeker->account_id,
                'sender_role' => 'admin',
                'receiver_role' => 'job_seeker',
                'notif_title' => $title,
                'notif_content' => $content,
                'received_at' => now(),
            ]);

            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send notification',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully',
            ]);
        } else {
            try {
                Mail::to($seeker->account->email)->send(new RestrictUserMail($title, $content));
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email: ' . $e->getMessage(),
                ]);
            }

            $update = Accounts::where('account_id', $seeker->account_id)->update([
                'is_approved' => 0,
            ]);

            $update_seeker = JobSeeker::where('seeker_id', $seeker->seeker_id)->update([
                'is_reported' => 0,
            ]);

            if (!$update) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update account but email sent successfully',
                ]);
            }

            if (!$update_seeker) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update job seeker',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully',
            ]);
        }
    }

    //all applied job of the job seeker
    public function appliedJobs(Request $request)
    {
        $seeker_id = $request->input('seeker_id');
        $appliedJobs = AppliedJob::with(['job.employer'])
            ->where('seeker_id', $seeker_id)
            ->get();

        if ($appliedJobs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No jobs found',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $appliedJobs->map(function ($appliedJob) {
                $job = $appliedJob->job;
                $employer = $job ? $job->employer : null;
                return [
                    'employer_id' => $employer ? $employer->employer_id : null,
                    'job_id' => $job ? $job->job_id : null,
                    'job_title' => $job ? $job->title : null,
                    'profile_pic' => $employer ? $employer->profile_pic : null,
                    'employer_name' => $employer ? trim($employer->first_name . ' ' . $employer->mid_name . ' ' . $employer->last_name . ' ' . $employer->suffix) : null,
                    'company_name' => $employer ? $employer->comp_name : null,
                    'employment_type' => $job ? $job->employment_type : null,
                    'applied_at' => $appliedJob->applied_at ? Carbon::parse($appliedJob->applied_at)->format('M d, Y') : null,
                    'expected_salary' => $job->expected_salary ?? null,
                    'salary_basis' => $job->salary_basis ?? null,
                    'location' => $job->location ?? null,
                    'status' => $appliedJob->status,
                ];
            }),
        ]);
    }
}
