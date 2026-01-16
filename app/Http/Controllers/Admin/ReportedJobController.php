<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportedJobController extends Controller
{
    //show all reported jobs
    public function show(Request $request)
    {
        $query = Job::with(['employer', 'reports'])
            ->where('is_reported', 1);

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

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No reported job found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Reported jobs found.',
            'data' => $result
        ]);
    }

    //view job data
    public function view($job_id)
    {
        $job = Job::where('job_id', $job_id)->firstOrFail();

        return view('design.admin.view-job', compact('job'));
    }

    //ignore reported job
    public function ignore(Request $request)
    {
        $report_id = $request->report_id;
        $job_id = $request->job_id;

        if (!isset($report_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Report ID is required.'
            ]);
        }

        if (!isset($job_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Job ID is required.'
            ]);
        }

        $reported_job = Job::where('job_id', $job_id)->first();
        if (!$reported_job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.'
            ]);
        }

        $reported_job->update(['is_reported' => 0]);

        $report_record = Report::where('report_id', $report_id)
            ->where('job_id', $job_id)
            ->first();

        if (!$report_record) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found.'
            ]);
        }

        $report_record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report was ignored successfully.'
        ]);
    }
}
