<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\FollowingEmployer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowingEmployerController extends Controller
{
    //get all following job seekers
    public function getFollowing(Request $request)
    {
        $account_id = Auth::id();
        $seeker_id = JobSeeker::where('account_id', $account_id)->value('seeker_id');

        $query = FollowingEmployer::with('employer')
            ->where('seeker_id', $seeker_id);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->whereHas('employer', function ($q) use ($search) {
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
                'message' => 'No employer found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Employer found.',
            'data' => $result->map(function ($emp) {
                $employer = $emp->employer;
                return [
                    'employer_id' => $employer->employer_id ?? null,
                    'profile_pic' => $employer->profile_pic ?? null,
                    'first_name' => $employer->first_name ?? null,
                    'mid_name' => $employer->mid_name ?? null,
                    'last_name' => $employer->last_name ?? null,
                    'suffix' => $employer->suffix ?? null,
                    'job_type' => $employer->job_type ?? null,
                    'barangay' => $employer->barangay ?? null,
                    'city' => $employer->city ?? null,
                    'followed_at' => $emp->followed_at,
                    'mute' => $emp->get_notified,
                ];
            }),
        ]);
    }

    //view job seeker
    public function viewEmployer($employer_id)
    {
        $employer = Employer::where('employer_id', $employer_id)->first();

        return view('design.seeker.view-employer', compact('employer'));
    }

    //unfollow job seeker
    public function unfollow(Request $request)
    {
        $account_id = Auth::id();
        $seeker_id = JobSeeker::where('account_id', $account_id)->value('seeker_id');
        $employer_id = $request->employer_id;

        $existing = FollowingEmployer::where('seeker_id', $seeker_id)->where('employer_id', $employer_id)->first();

        if ($existing) {
            $existing->delete();
        }

        return response()->json([
            'success' => true
        ]);
    }

    //mute notification for employer
    public function muteNotification(Request $request)
    {
        $account_id = Auth::id();
        $seeker_id = JobSeeker::where('account_id', $account_id)->value('seeker_id');
        $employer_id = $request->employer_id;
        $get_notified = $request->mute;

        // Find the following record
        $notified = FollowingEmployer::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer_id)
            ->first();

        if (!$notified) {
            return response()->json([
                'success' => false,
                'message' => 'Following employer not found.'
            ], 404);
        }

        if ($get_notified == 1) {
            $notified->get_notified = 0;
        } else {
            $notified->get_notified = 1;
        }
        $notified->save();

        return response()->json([
            'success' => true
        ]);
    }
}
