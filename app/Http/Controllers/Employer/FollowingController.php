<?php

namespace App\Http\Controllers\Employer;

use App\Models\Employer;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use App\Models\FollowingJobSeeker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    //get all following job seekers
    public function getFollowing(Request $request)
    {
        $account_id = Auth::id();
        $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

        $query = FollowingJobSeeker::with('job_seeker')
            ->where('employer_id', $employer_id);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->whereHas('job_seeker', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('mid_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        switch ($request->sort) {
            case 'newest':
                $query->orderBy('followed_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('followed_at', 'asc');
                break;
            default:
                $query->orderBy('followed_at', 'desc');
                break;
        }

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No job seeker found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Job seeker found.',
            'data' => $result->map(function ($seeker) {
                $jobSeeker = $seeker->job_seeker;
                return [
                    'seeker_id' => $jobSeeker->seeker_id ?? null,
                    'profile_pic' => $jobSeeker->profile_pic ?? null,
                    'first_name' => $jobSeeker->first_name ?? null,
                    'mid_name' => $jobSeeker->mid_name ?? null,
                    'last_name' => $jobSeeker->last_name ?? null,
                    'suffix' => $jobSeeker->suffix ?? null,
                    'job_type' => $jobSeeker->job_type ?? null,
                    'barangay' => $jobSeeker->barangay,
                    'city' => $jobSeeker->city,
                    'followed_at' => $seeker->followed_at,
                ];
            }),
        ]);
    }

    //view job seeker
    public function viewJobSeeker($seeker_id)
    {
        $jobSeeker = JobSeeker::where('seeker_id', $seeker_id)->first();

        return view('design.employer.view-seeker', compact('jobSeeker'));
    }

    //unfollow job seeker
    public function unfollow(Request $request)
    {
        $seeker_id = $request->seeker_id;

        $existing = FollowingJobSeeker::where('seeker_id', $seeker_id)->first();

        if ($existing) {
            $existing->delete();
        }

        return response()->json([
            'success' => true
        ]);
    }
}
