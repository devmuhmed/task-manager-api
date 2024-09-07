<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->where('read', false)->get();
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        Notification::where('id',$id)->update(['read' => true]);
        return response()->json(['message' => 'Notification marked as read.']);
    }
}
