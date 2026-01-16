<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class ApprovedMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = FacadesAuth::user();

        if ($user && !$user->is_approved) {
            // If it's an AJAX request, return JSON response instead of redirect
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is not approved. Please complete your profile verification.',
                    'redirect' => route($role === 'job_seeker' ? 'js.profile' : 'emp.profile')
                ], 403);
            }

            return redirect()->route($role === 'job_seeker' ? 'js.profile' : 'emp.profile');
        }

        return $next($request);
    }
}
