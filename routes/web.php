<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
