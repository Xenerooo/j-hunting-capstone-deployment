<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    //change password functionality
    public function changePassword(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', Password::min(8)->numbers()->symbols()]
        ]);

        $savedPassword = Accounts::where('account_id', $userID)->where('user_type', 'job_seeker')->value('password');

        if (!$savedPassword || !Hash::check($request->current_password, $savedPassword)) {
            return response()->json([
                'success' => false,
                'message' => 'Your current password is incorrect.'
            ]);
        }

        $updated = Accounts::where('account_id', $userID)
            ->where('user_type', 'job_seeker')
            ->update(['password' => Hash::make($request->new_password)]);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => "Your password cannot be changed."
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Your password has been changed."
        ]);
    }

    public function deleteAccount(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'password' => 'required',
            'password_confirmation' => ['required', 'same:password']
        ]);

        $password = Accounts::where('account_id', $userID)->where('user_type', 'job_seeker')->value('password');

        if (!$password || !Hash::check($request->password, $password)) {
            return response()->json([
                'success' => false,
                'message' => 'Your password is incorrect.'
            ]);
        }

        $delete_account = Accounts::where('account_id', $userID)->where('user_type', 'job_seeker')->firstOrFail();

        if (!$delete_account) {
            return response()->json([
                'success' => false,
                'message' => "Your account cannot be deleted."
            ]);
        }

        $delete_account->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
