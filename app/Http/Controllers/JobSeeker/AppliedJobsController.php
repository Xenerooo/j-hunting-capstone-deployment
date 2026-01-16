<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Job;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    //get all applied jobs
    public function getApplied(Request $request)
    {
        $account_id = Auth::id();
        $seeker_id = JobSeeker::where('account_id', $account_id)->value('seeker_id');

        $query = AppliedJob::with('employer', 'job')->where('seeker_id', $seeker_id);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($query) use ($search) {
                $query->whereHas('employer', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('mid_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                        ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
                })
                    ->orWhereHas('job', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }

        switch ($request->sort) {
            case 'newest':
                $query->orderBy('applied_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('applied_at', 'asc');
                break;
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'accepted':
                $query->where('status', 'accepted');
                break;
            case 'interview':
                $query->where('status', 'interview');
                break;
            case 'rejected':
                $query->where('status', 'rejected');
                break;
            default:
                $query->orderBy('applied_at', 'desc');
                break;
        }

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No employer or job found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $result->map(function ($appliedJob) {
                $employer = $appliedJob->employer;
                $job = $appliedJob->job;

                return [
                    'applied_id' => $appliedJob->applied_id,
                    'status' => $appliedJob->status,
                    'applied_at' => $appliedJob->applied_at,
                    'employer_id' => $employer->employer_id ?? null,
                    'profile_pic' => $employer->profile_pic ?? null,
                    'first_name' => $employer->first_name,
                    'mid_name' => $employer->mid_name ?? null,
                    'last_name' => $employer->last_name,
                    'suffix' => $employer->suffix ?? null,
                    'comp_name' => $employer->comp_name ?? null,
                    'job_id' => $job->job_id,
                    'title' => $job->title,
                    'employment_type' => $job->employment_type,
                    'expected_salary' => $job->expected_salary,
                    'salary_basis' => $job->salary_basis,
                    'location' => $job->location,
                ];
            }),
        ]);
    }
}
