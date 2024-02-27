<?php

namespace App\Services;

use App\Repositories\NotificationRepositoryInterface;

class NotificationService implements NotificationServiceInterface
{
    protected $notificationRepository;
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }
    public function store($data)
    {
        return $this->notificationRepository->store($data);
    }
}