<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Interview;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobInterviewController extends Controller
{
    //get all interview
    public function getInterview(Request $request)
    {
        $account_id = Auth::id();
        $seeker_id = JobSeeker::where('account_id', $account_id)->value('seeker_id');

        $query = Interview::with('employer', 'job')
            ->where('seeker_id', $seeker_id);

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
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        if ($request->filled('sort_date')) {
            $date = $request->input('sort_date');
            $query->whereDate('interview_date', '=', $date);
        }

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No interview found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Interviews found.',
            'data' => $result->map(function ($data) {
                $employer = $data->employer;
                $job = $data->job;
                return [
                    'interview_id' => $data->interview_id ?? null,
                    'seeker_id' => $employer->seeker_id ?? null,
                    'job_id' => $job->job_id ?? null,
                    'profile_pic' => $employer->profile_pic ?? null,
                    'first_name' => $employer->first_name ?? null,
                    'mid_name' => $employer->mid_name ?? null,
                    'last_name' => $employer->last_name ?? null,
                    'suffix' => $employer->suffix ?? null,
                    'job_type' => $employer->job_type ?? null,
                    'barangay' => $employer->barangay,
                    'city' => $employer->city ?? null,
                    'title' => $job->title ?? null,
                    'status' => $data->status ?? null,
                    'interview_date' => $data->interview_date ?? null,
                    'mode' => $data->mode ?? null,
                    'detail' => $data->detail ?? null,
                ];
            }),
        ]);
    }
}
