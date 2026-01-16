<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Employer;
use App\Exports\JobsExport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AllJobController extends Controller
{
    //get all job
    public function getAllJob(Request $request)
    {
        $query = Job::with(['employer', 'jobTypes' => function ($qry) {
            $qry->select('job_id', 'job_type');
        }])->where('status', 'accepted');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
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
                'message' => 'No job found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Jobs found.',
            'data' => $jobs,
        ]);
    }

    //download all job
    public function download(Request $request)
    {
        $month = $request->input('month', date('F'));
        $year = $request->input('year', date('Y'));
        $sort = $request->input('sort', 'all');

        return Excel::download(new JobsExport($month, $year, $sort), "jobs_{$month}_{$year}.xlsx");
    }

    //view job
    public function view($job_id)
    {
        $job = Job::where('job_id', $job_id)->firstOrFail();
        return view('design.admin.view-job', compact('job'));
    }

    //get job details
    public function getJobDetails(Request $request)
    {
        $job_id = $request->input('job_id');
        $job = Job::with('employer')->where('job_id', $job_id)->firstOrFail();
        $job_type = JobType::where('job_id', $job_id)->pluck('job_type');

        return response()->json([
            'success' => true,
            'data' => $job,
            'job_type' => $job_type,
        ]);
    }

    //send message to the user
    public function sendMessage(Request $request)
    {
        $sender_id = Auth::id();
        $receiver_id = Employer::where('employer_id', $request->employer_id)->value('account_id');
        $notif_title = "";
        $notif_content = "";
        $receiver_role = "employer";
        $sender_role = "admin";

        if ($request->is_warning) {

            $request->validate([
                'title' => ['required'],
                'content' => ['required']
            ]);

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
            'received_at' => now(),
        ];

        $notification = Notification::create($data);

        if (!$notification) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Notification not sent.'
                ]
            );
        }

        //restrict job
        if ($request->is_warning === "false") {

            $jobID = $request->job_id;
            $job = Job::where('job_id', $jobID)->update(['status' => 'restricted']);

            if (!$job) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Failed to restrict job.',
                    ]
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job restricted successfully.',
                    'is_warning' => $request->is_warning,
                ]
            );
        }

        //warning job
        return response()->json(
            [
                'success' => true,
                'message' => 'Job warning sent successfully.',
                'is_warning' => $request->is_warning,
            ]
        );
    }
}
