<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function displaySignUp(Request $request)
    {
        $user_type = session('user_type', 'job_seeker');

        return view('auth.sign-up', compact('user_type'));
    }

    public function updateUserType(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:job_seeker,employer',
        ]);

        session(['user_type' => $request->user_type]);

        return response()->json(['status' => 'success', 'userType' => $request->user_type]);
    }

    public function emailSent()
    {
        return view('auth.email-sent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|max:50|unique:accounts|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->numbers()
                    ->symbols(),
            ],
            'user_type' => 'required',
        ]);

        $account = Accounts::create([
            "email" => $request->email,
            "user_type" => $request->user_type,
            "password" => Hash::make($request->password),
            "verify_token" => Str::random(65),
            "is_verified" => false,
            "is_approved" => false,
        ]);

        Mail::to($account->email)->send(new VerifyEmail($account));

        return response()->json([
            'status' => 'success',
            'title' => 'Email Verification',
            'message' => 'Email sent successfully, please verify your email.',
        ], 200);
    }

    public function sendEmail(Request $request)
    {
        $account = Accounts::where('email', $request->email)->first();

        if (!$account) {
            return back()->with('error', 'Account not found.');
        }

        if ($account->is_verified) {
            return back()->with('success', 'This account is already verified.');
        }

        Mail::to($account->email)->send(new VerifyEmail($account));

        return back()->with('success', 'Verification email sent!');
    }


    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $account = Accounts::where('verify_token', $token)->first();

        if (!$account) {
            return redirect()->route('index')->with('error', 'Invalid or expired verification token.');
        }

        $account->is_verified = true;
        $account->save();

        return redirect('/')->with('success', 'Your email has been verified! You can now log in.');
    }
}
