<?php

Route::get('/', 'PostController@showAll')->name('welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/post/add', function() {
        return view('add-post');
    });

    Route::post('/post/add', 'PostController@addPost');
});


Route::get('/post/{id}', 'PostController@show')->name('single-post');
Route::post('/post/{id}', 'CommentController@addComment');

Auth::routes();
