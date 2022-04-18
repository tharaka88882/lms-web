<?php

namespace App\Traits;

use App\Models\Notification;

trait UserTrait
{
    public function createNotification($user_id, $message, $url='#'){
        $notification = new Notification();
        $notification->user_id=$user_id;
        $notification->message=$message;
        $notification->url=$url;
        $notification->save();
        return $notification;
    }

}
