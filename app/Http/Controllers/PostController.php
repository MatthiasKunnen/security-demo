<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\ViewModels\PostViewModel;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{

    /**
     * Add a post.
     *
     * @param PostRequest $postRequest Rules that the request has to abide by.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPost(PostRequest $postRequest)
    {
        DB::statement(sprintf('INSERT INTO posts (user_id, created_at, title, content) VALUES
            ("%s", "%s", "%s", "%s")',
            auth()->user()->id,
            Carbon::now()->toDateTimeString(),
            $postRequest->get('title'),
            $postRequest->get('content')));
        $idStatement = DB::select('SELECT LAST_INSERT_ID()');
        $id = array_values((array)$idStatement[0])[0];
        return redirect()->route('single-post', $id)->with('success', trans('post.created'));
    }

    /**
     * Displays a single post or reroutes to show all the posts with a not found error when
     * the post_id does not exist.
     *
     * @param $id integer The ID of the post to display.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post === null) {
            return redirect()->route('welcome')->with('error', trans('post.not_found'));
        }
        return view('post', ['post' => new PostViewModel($post)]);
    }

    /**
     * Shows all posts.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        return view('welcome', ['posts' => Post::all()->map(function ($item) {
            return new PostViewModel($item);
        })]);
    }
}
