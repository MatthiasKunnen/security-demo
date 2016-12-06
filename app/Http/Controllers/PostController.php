<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\ViewModels\PostViewModel;

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
        $post = new Post();
        $post->fill($postRequest->all());
        $post->user_id = auth()->id();
        $post->save();
        return redirect()->route('single-post', $post->id)->with('success', trans('post.created'));
    }

    /**
     * Displays a single post or reroutes to show all the posts with a not found error when
     * the post does not exist.
     *
     * @param $post Post|null The post to display.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($post = null)
    {
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
