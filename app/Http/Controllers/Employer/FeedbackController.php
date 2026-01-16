<?php

namespace App\Http\Controllers\Employer;

use App\Models\Accounts;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function getEmail()
    {
        $userID = Auth::id();

        $email = Accounts::where('account_id', $userID)->get('email')->first();

        return response()->json([
            'success' => true,
            'data' => $email
        ]);
    }

    public function sendFeedback(Request $request)
    {
        $userID = Auth::id();

        $sendFeedback = Feedback::create([
            'account_id' => $userID,
            'content' => $request->feedback_content,
            'rating' => $request->rating,
            'feedback_at' => Carbon::now()
        ]);

        if (!$sendFeedback) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send feedback, please try again.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thanks for your feedback!'
        ]);
    }
}
