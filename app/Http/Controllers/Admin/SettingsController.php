<?php

namespace App\Http\Controllers\Admin;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    //change password
    public function changePassword(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', Password::min(8)->numbers()->symbols()]
        ]);

        $savedPassword = Accounts::where('account_id', $userID)->value('password');

        if (!Hash::check($request->current_password, $savedPassword)) {
            return response()->json([
                'success' => false,
                'message' => 'Your current password is incorrect.'
            ]);
        }

        $updated = Accounts::where('account_id', $userID)->update(['password' => Hash::make($request->new_password)]);

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
}
