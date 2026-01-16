<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Employer;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'employer' => [],
            ]);
        }

        $senderIds = $notifications->pluck('sender_id')->unique()->filter(fn($id) => $id != 1);

        $employer = Employer::whereIn('account_id', $senderIds)->get()->keyBy('account_id');

        $employerData = $notifications->map(function ($notif) use ($employer) {
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

            $employer = $employer->get($notif->sender_id);
            return [
                'profile_pic' => $employer?->profile_pic,
                'first_name' => $employer?->first_name,
                'mid_name' => $employer?->mid_name,
                'last_name' => $employer?->last_name,
                'suffix' => $employer?->suffix,
                'is_admin' => false,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'employer' => $employerData,
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
