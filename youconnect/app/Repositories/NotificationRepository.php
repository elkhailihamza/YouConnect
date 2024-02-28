<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function store($data)
    {
        Notification::create($data);
    }
}