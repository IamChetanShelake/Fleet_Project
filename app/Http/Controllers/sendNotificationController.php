<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sendNotificationController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $page  = (int) $request->input('page', 1);
    $limit = (int) $request->input('limit', 10);

    // protect DB
    $limit = min(max($limit, 1), 50);

    $notifications = $user->notifications()->paginate(
        $limit,
        ['*'],
        'page',
        $page
    );

    return response()->json([
        'notifications' => $notifications->getCollection()->map(function ($notification) {
            return [
                'id' => $notification->id,
                'title' => $notification->data['title'] ?? null,
                'message' => $notification->data['message'] ?? null,
                'type' => $notification->data['type'] ?? null,
                'is_read' => $notification->read_at !== null,
                'read_at' => $notification->read_at,
                'time' => $notification->created_at->diffForHumans(),
            ];
        }),

        'pagination' => [
            'current_page' => $notifications->currentPage(),
            'last_page' => $notifications->lastPage(),
            'per_page' => $notifications->perPage(),
            'total' => $notifications->total(),
            'has_more' => $notifications->hasMorePages(),
        ],

        'unread_count' => $user->unreadNotifications()->count(),
    ]);
}
    // GET /notifications/unread - Get unread only
    public function unread(Request $request)
    {
        $user = $request->user();
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'notifications' => $request->user()->unreadNotifications
        ]);
    }
     // POST /notifications/{id}/read - Mark as read
     public function markAsRead(Request $request)
    {
        $user = $request->user();
        $id = $request->notificationId;
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return response()->json(['message' => 'Marked as read']);
    }

    // POST /notifications/read-all - Mark all as read
    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->user()->unreadNotifications->markAsRead();
        
        return response()->json(['message' => 'All marked as read']);
    }

    // DELETE /notifications/{id} - Delete notification
     public function destroy(Request $request)
    {
        $user = $request->user();
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notification = auth()->user()->notifications()->findOrFail($request->notificationId);
        $notification->delete();
        
        return response()->json([
            'message' => 'Notification deleted',
            ]);
    }

    // DELETE /notifications - Delete all
    public function destroyAll(Request $request)
    {
        $user = $request->user();
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->user()->notifications()->delete();
        
        return response()->json(['message' => 'All notifications deleted']);
    }


    public function sendNotification(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Create a new notification instance
        $notification = new \App\Notifications\sendNotification(
            'Notification Title', // Title of the notification
            'This is the notification message.', // Message content
            'info' // Type of notification (e.g., info, success, error)
        );

        // Send the notification to the user
        $user->notify($notification);

        return response()->json(['message' => 'Notification sent successfully']);
    }
}
