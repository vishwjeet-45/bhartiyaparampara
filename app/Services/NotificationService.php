<?php
namespace App\Services;

use App\Models\backend\Notification;

class NotificationService
{
    public function getNotify($title, $description, $type = "", $status, $source, $user_id = NULL)
    {
        $notification = Notification::create([
            "title" => $title,
            "description" => $description,
            "notification_type" => $type,
            "notification_status" => $status,
            "notification_source" => $source,
            "user_id" => $user_id
        ]);

        return $notification ? "ok" : "not ok";
    }
}
