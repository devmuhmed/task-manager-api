<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function create(array $data)
    {
        return Notification::create($data);
    }

    public function getUnreadByUser($userId)
    {
        return Notification::where('user_id', $userId)->where('read', false)->get();
    }
}
