<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\ViewModels\PostSearchResultViewModel;
use App\ViewModels\PostViewModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll(Request $request)
    {
        if ($request->has('query')) {
            return $this->find($request);
        }
        return view('welcome', ['posts' => $this->getAllPosts()]);
    }

    /**
     * Find posts with certain content.
     *
     * @param FormRequest $request The request containing the keywords that need to be found.
     */
    public function find(Request $request)
    {
        if (!$request->has('query')) {
            return $this->showAll($request);
        }

        $result = DB::select('SELECT id, created_at, title, content FROM posts WHERE content LIKE "%' . $request->get('query') . '%"');
        $returnedResults = new Collection();

        foreach ($result as $rowObject) {
            $row = (array)$rowObject;
            $post = new PostSearchResultViewModel();
            $post->id = $row['id'];
            $post->created_at = $row['created_at'];
            $post->title = $row['title'];
            $post->content = $row['content'];
            $returnedResults->push($post);
        }

        return view('welcome', [
            'posts' => $this->getAllPosts(),
            'search_results' => $returnedResults,
        ]);
    }

    /**
     * Returns all posts in a PostViewModel format.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getAllPosts()
    {
        return Post::all()->map(function ($item) {
            return new PostViewModel($item);
        });
    }
}
