<?php

use App\Models\Post;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');

Route::get('/', 'PostController@showAll')->name('welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/post/add', function () {
        return view('add-post');
    });

    Route::post('/post/add', 'PostController@addPost');
});

Route::bind('post', function ($post_id) {
    return Post::find($post_id);
});

Route::get('/post/{post}', 'PostController@show')->name('single-post');
Route::post('/post/{post}', 'CommentController@addComment');


Auth::routes();
