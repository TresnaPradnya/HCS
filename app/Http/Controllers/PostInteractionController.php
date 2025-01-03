<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Notifications\PostLikedNotification;
use App\Notifications\PostCommentedNotification;

class PostInteractionController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'type' => 'required|in:like,comment',
            'content' => 'required_if:type,comment|max:255',
        ]);

        $interaction = $post->interactions()->create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'content' => $request->type === 'comment' ? $request->content : null,
        ]);

        // Notify the post owner
        if ($request->type === 'like') {
            $post->user->notify(new \App\Notifications\PostLikedNotification(auth()->user(), $post));
        } elseif ($request->type === 'comment') {
            $post->user->notify(new \App\Notifications\PostCommentedNotification(auth()->user(), $post, $request->content));
        }

        return back()->with('success', ucfirst($request->type) . ' added!');
    }

    // Remove a like
    public function unlike(Post $post)
    {
        $post->interactions()->where('user_id', auth()->id())->where('type', 'like')->delete();

        return back()->with('success', 'Like removed!');
    }
}
