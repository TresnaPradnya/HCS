<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $commenter;
    protected $post;
    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($commenter, Post $post, $comment)
    {
        $this->commenter = $commenter; // The user who commented
        $this->post = $post; // The post that was commented on
        $this->comment = $comment; // The comment content
    }

    /**
     * Get the notification's delivery channels.
     *
     */
    public function via(object $notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     */
    public function toArray(object $notifiable)
    {
        return [
            'message' => "{$this->commenter->name} commented on your post: \"{$this->comment}\"",
            'post_id' => $this->post->id,
        ];
    }
}
