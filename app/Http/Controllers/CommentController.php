<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Carbon\Carbon;
use DB;

class CommentController extends Controller
{

    /**
     * Add a comment to a post.
     * @param CommentRequest $commentRequest
     * @return \Illuminate\Http\Response
     */
    public function addComment(CommentRequest $commentRequest){
        DB::statement(sprintf('INSERT INTO security_demo.comments (user_id, post_id, created_at, content) VALUES
            ("%s", "%s", "%s", "%s")',
            auth()->user()->id,
            $commentRequest->get('post_id'),
            Carbon::now()->toDateTimeString(),
            $commentRequest->get('content')));
        $idStatement = DB::select('SELECT LAST_INSERT_ID()');
        $id = array_values((array)$idStatement[0])[0];
        $url = sprintf('%s/#comment-%s', route('single-post', ['id' => $commentRequest->get('post_id')]), $id);
        return redirect($url)->with('success', trans('post.comment_created'));
    }
}
