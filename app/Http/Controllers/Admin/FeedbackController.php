<?php

namespace App\Http\Controllers\Admin;

use App\Models\Accounts;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    //get all feedback
    public function getFeedback(Request $request)
    {
        $account_id = Accounts::where('is_approved', 1)
            ->pluck('account_id');

        $query = Feedback::with(['account.job_seeker', 'account.employer'])
            ->whereIn('account_id', $account_id);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('account', function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $sortBy = $request->input('sort');
            switch ($sortBy) {
                case 'one_star':
                    $query->where('rating', 1);
                    break;
                case 'two_stars':
                    $query->where('rating', 2);
                    break;
                case 'three_stars':
                    $query->where('rating', 3);
                    break;
                case 'four_stars':
                    $query->where('rating', 4);
                    break;
                case 'five_stars':
                    $query->where('rating', 5);
                    break;
                default:
                    $query->orderByDesc('feedback_at');
                    break;
            }
        }

        $results = $query->get()->map(function ($feedback) {
            $account = $feedback->account;
            $profile_pic = null;

            if ($account->user_type === 'job_seeker' && $account->job_seeker) {
                $profile_pic = $account->job_seeker->profile_pic;
            } else if ($account->user_type === 'employer' && $account->employer) {
                $profile_pic = $account->employer->profile_pic;
            }

            return [
                'feedback_id' => $feedback->feedback_id,
                'account_id' => $feedback->account_id,
                'email' => $account->email,
                'rating' => $feedback->rating,
                'content' => $feedback->content,
                'is_displayed' => $feedback->is_displayed,
                'feedback_at' => $feedback->feedback_at,
                'profile_pic' => $profile_pic,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }

    //get feedback details
    public function getFeedbackDetails(Request $request)
    {
        $feedback = Feedback::with('account')
            ->find($request->feedback_id);

        return response()->json([
            'success' => true,
            'data' => $feedback,
        ]);
    }

    public function displayFeedback(Request $request)
    {
        $request->validate([
            'feedback_id' => 'required|integer|exists:feedback,feedback_id',
            'is_accept' => 'required|in:true,false'
        ]);

        $feedback = Feedback::find($request->feedback_id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback not found.',
            ], 404);
        }

        if ($request->is_accept === 'true') {
            $feedback->is_displayed = 1;
            $feedback->save();

            return response()->json([
                'success' => true,
                'message' => 'Feedback has been displayed to the dashboard.',
            ]);
        } else {
            $feedback->delete();

            return response()->json([
                'success' => true,
                'message' => 'Feedback has been deleted.',
            ]);
        }
    }
}
