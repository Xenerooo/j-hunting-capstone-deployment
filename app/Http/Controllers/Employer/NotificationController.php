<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    //get all notification
    public function getNotification(Request $request)
    {
        $accountId = Auth::id();
        $sort = $request->input('sort', 'all');

        $query = Notification::where('receiver_id', $accountId);

        $sortOrder = match ($sort) {
            'newest' => ['received_at', 'desc'],
            'oldest' => ['received_at', 'asc'],
            default => ['received_at', 'desc'],
        };

        $notifications = $query->orderBy(...$sortOrder)->get();

        if ($notifications->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'jobseeker' => [],
            ]);
        }

        $senderIds = $notifications->pluck('sender_id')->unique()->filter(fn($id) => $id != 1);

        $jobseekers = JobSeeker::whereIn('account_id', $senderIds)->get()->keyBy('account_id');

        $jobseekerData = $notifications->map(function ($notif) use ($jobseekers) {
            if ($notif->sender_id == 1) {
                // Admin sender
                return [
                    'profile_pic' => null,
                    'first_name' => 'J-Hunting',
                    'mid_name' => null,
                    'last_name' => 'Admin',
                    'suffix' => null,
                    'is_admin' => true,
                ];
            }

            $seeker = $jobseekers->get($notif->sender_id);
            return [
                'profile_pic' => $seeker?->profile_pic,
                'first_name' => $seeker?->first_name,
                'mid_name' => $seeker?->mid_name,
                'last_name' => $seeker?->last_name,
                'suffix' => $seeker?->suffix,
                'is_admin' => false,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'jobseeker' => $jobseekerData,
        ]);
    }

    //delete specified notificaitons
    public function deleteNotification(Request $request)
    {
        $notif_id = $request->input('notif_id');

        if (!$notif_id) {
            return response()->json([
                'success' => false,
                'message' => 'Notification ID is required.',
            ]);
        }

        $notification = Notification::find($notif_id);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.',
            ]);
        }

        try {
            $notification->delete();
            return response()->json([
                'success' => true,
                'message' => 'Notification deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete notification. ' . $e->getMessage(),
            ]);
        }
    }
}
