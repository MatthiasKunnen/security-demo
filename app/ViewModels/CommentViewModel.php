<?php

namespace App\ViewModels;

use App\Models\Comment;

class CommentViewModel
{

    /**
     * Create CommentViewModel from Comment that is bound to a PostViewModel.
     *
     * @param Comment $comment
     * @param PostViewModel $postViewModel
     * @see PostViewModel
     */
    public function __construct(Comment $comment, PostViewModel $postViewModel)
    {
        $this->id = $comment->id;
        $this->created_at = $comment->created_at;
        $this->content = $comment->content;
        $this->author = $comment->user->username;
        $this->post = $postViewModel;
    }
}
