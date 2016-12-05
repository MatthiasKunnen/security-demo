<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Carbon\Carbon;
use DB;

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
        DB::statement(sprintf('INSERT INTO comments (user_id, post_id, created_at, content) VALUES
            ("%s", "%s", "%s", "%s")',
            auth()->user()->id,
            $post->id,
            Carbon::now()->toDateTimeString(),
            $commentRequest->get('content')));
        $idStatement = DB::select('SELECT LAST_INSERT_ID()');
        $id = array_values((array)$idStatement[0])[0];
        $url = sprintf('%s/#comment-%s', route('single-post', ['id' => $post->id]), $id);
        return redirect($url)->with('success', trans('post.comment_created'));
    }
}
