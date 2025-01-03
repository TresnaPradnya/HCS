<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $liker;
    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($liker, Post $post)
    {
        $this->liker = $liker; // The user who liked the post
        $this->post = $post; // The post that was liked
    }

    /**
     * Get the notification's delivery channels.
     *
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->liker->name} liked your post.",
            'post_id' => $this->post->id,
        ];
    }
}
