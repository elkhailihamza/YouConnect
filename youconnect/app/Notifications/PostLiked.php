<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    protected $postDescription;

    public function __construct($postDescription)
    {
        $this->postDescription = $postDescription;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $notifiable->name . ' a aimé votre poste : "' . $this->postDescription . '".'
        ];
    }
}
