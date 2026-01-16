<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;


class SignInController extends Controller
{

    public function signIn()
    {
        return view('auth.sign-in');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function passwordReset()
    {
        return view('auth.reset-password');
    }

    public function authenticate(Request $request)
    {
        //validate credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $existing = Accounts::where('email', $request->email)->first();
        if (is_null($existing)) {
            return back()->withErrors([
                'email' => 'User not found. Please register first.',
            ])->onlyInput('email');
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Your password is incorrect.',
            ])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user->is_verified) {
            Auth::logout();
            return back()->with([
                'not_verified' => true,
                'resend_url' => route('send.email', ['email' => $user->email])
            ])->onlyInput('email');
        }

        $user->update(['logged_in_at' => now(), 'is_active' => 1]);

        switch ($user->user_type) {
            case 'job_seeker':
                return redirect()->route('js.dashboard');
                break;
            case 'employer':
                return redirect()->route('emp.dashboard');
                break;
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
        }
    }

    public function logout(Request $request)
    {
        //executes all when logging out
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'success' => true
        ]);
    }

    public function forgotPasswordLink(Request $request)
    {
        //validate the email
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function resetPasswordLink(Request $request)
    {
        //validate all the input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        //process the password reset
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        //return json
        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'You have successfully change your password.'])
            : response()->json(['message' => __($status)], 400);
    }
}
