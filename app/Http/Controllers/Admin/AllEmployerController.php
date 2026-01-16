<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Accounts;
use App\Models\Employer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\EmployersExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Admin\RestrictUserMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AllEmployerController extends Controller
{
    //get all employer
    public function getAllEmployer(Request $request)
    {
        $approvedAccountIds = Accounts::where('is_approved', 1)
            ->where('user_type', 'employer')
            ->pluck('account_id');

        $query = Employer::with(['account', 'jobTypes' => function ($qry) {
            $qry->select('employer_id', 'job_type');
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

    //download all employer
    public function download(Request $request)
    {
        $month = $request->input('month', date('F'));
        $year = $request->input('year', date('Y'));
        $sort = $request->input('sort', 'all');

        return Excel::download(new EmployersExport($month, $year, $sort), "employers_{$month}_{$year}.xlsx");
    }

    //view employer
    public function view($employer_id)
    {
        $employer = Employer::where('employer_id', $employer_id)->firstOrFail();
        return view('design.admin.view-employer', compact('employer'));
    }

    //get profile data of employer
    public function getProfileData(Request $request)
    {
        $employer_id = $request->input('employer_id');
        $employer = Employer::with('account')->where('employer_id', $employer_id)->firstOrFail();
        $job_types = JobType::where('employer_id', $employer_id)->pluck('job_type');

        return response()->json([
            'success' => true,
            'data' => $employer,
            'job_types' => $job_types,
        ]);
    }

    //send message to the user
    public function sendMessage(Request $request)
    {
        $sender_id = Auth::id();

        $employer_id = $request->input('employer_id');
        $employer = Employer::where('employer_id', $employer_id)->firstOrFail();
        $title = $request->input('title');
        $content = $request->input('content');

        if ($request->input('is_warning') === "true") {
            $request->validate([
                'title' => ['required'],
                'content' => ['required']
            ]);

            $notification = Notification::create([
                'sender_id' => $sender_id,
                'receiver_id' => $employer->account_id,
                'sender_role' => 'admin',
                'receiver_role' => 'employer',
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
                Mail::to($employer->account->email)->send(new RestrictUserMail($title, $content));
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email: ' . $e->getMessage(),
                ]);
            }

            $update = Accounts::where('account_id', $employer->account_id)->update([
                'is_approved' => 0,
            ]);

            $update_employer = Employer::where('employer_id', $employer->employer_id)->update([
                'is_reported' => 0,
            ]);

            $hide_jobs = Job::where('employer_id', $employer->employer_id)->get();
            foreach ($hide_jobs as $job) {
                $job->update(['is_available' => 0]);
            }

            if (!$update) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update account but email sent successfully',
                ]);
            }

            if (!$update_employer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update employer',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully',
            ]);
        }
    }

    //all posted job of the employer
    public function postedJobs(Request $request)
    {
        $employer_id = $request->input('employer_id');
        $jobs = Job::with('employer')->where('employer_id', $employer_id)->get();

        if (!$jobs) {
            return response()->json([
                'success' => false,
                'message' => 'No jobs found',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $jobs->map(function ($job) {
                return [
                    'job_id' => $job->job_id,
                    'job_title' => $job->title,
                    'posted_at' => $job->created_at->format('F d, Y'),
                    'profile_pic' => $job->employer->profile_pic,
                    'employer_name' => $job->employer->first_name . ' ' . $job->employer->mid_name . ' ' . $job->employer->last_name . ' ' . $job->employer->suffix,
                    'status' => $job->status,
                    'max_applicants' => $job->max_applicant,
                    'hired_applicants' => $job->hired_applicant,
                ];
            }),
        ]);
    }
}
