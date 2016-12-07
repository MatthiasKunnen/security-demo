<?php

namespace App\ViewModels;

use App\Models\Post;

class PostViewModel
{

    /**
     * Create PostViewModel from Post.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        if ($post !== null) {
            $this->id = $post->id;
            $this->created_at = $post->created_at;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->author = $post->user->username;
            $this->comments = $post->comments->map(function($item) {
                return new CommentViewModel($item, $this);
            });
        }
    }
}
