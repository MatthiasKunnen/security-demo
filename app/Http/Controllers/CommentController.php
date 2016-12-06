<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    /**
     * Add a comment to a post.
     * @param CommentRequest $commentRequest
     * @param Post $post |null Post to attach the comment to.
     * @return \Illuminate\Http\Response
     */
    public function addComment(CommentRequest $commentRequest, $post = null)
    {
        if ($post === null) {
            return redirect()->route('welcome')->with('error', trans('post.not_found'));
        }

        $comment = new Comment();
        $comment->fill($commentRequest->all());
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        $url = sprintf('%s/#comment-%s', route('single-post', ['id' => $post->id]), $comment->id);
        return redirect($url)->with('success', trans('post.comment_created'));
    }
}
