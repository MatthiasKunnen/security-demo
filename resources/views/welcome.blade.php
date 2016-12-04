@extends('layouts.default')

@section('title', trans('welcome.title'))

@section('content')
    <h1 class="page-title">{{trans_choice('post.post', 2)}}</h1>
    @each('includes.post', $posts, 'post')
@stop
