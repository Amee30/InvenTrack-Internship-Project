<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display user notifications
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->with('borrowing.barang')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications for dropdown
     */
    public function getRecent()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->with('borrowing.barang')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'borrowing_id' => $notification->borrowing_id,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->toISOString(),
                ];
            });

        return response()->json($notifications);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->findOrFail($id);
        
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->findOrFail($id);
        
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Create notification for specific user
     */
    public static function createNotification($userId, $type, $title, $message, $borrowingId = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'borrowing_id' => $borrowingId,
        ]);
    }

    /**
     * Notify all admins
     */
    public static function notifyAdmins($type, $title, $message, $borrowingId = null)
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            self::createNotification($admin->id, $type, $title, $message, $borrowingId);
        }
    }
}
