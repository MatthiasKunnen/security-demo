@extends('layouts.default')

@section('title', trans('welcome.title'))

@section('content')
    <div class="row clearfix">
        <form class="form col-xs-12">
            <div class="form-group col-md-11">
                <label class="sr-only">{{ trans('post.search_a_post') }}</label>
                <input type="text" class="form-control" name="query" id="query"
                       placeholder="{{ trans('post.search_a_post') }}">
            </div>
            <button class="btn btn-default btn-primary col-md-1">
                {{ trans('post.search') }}
            </button>
        </form>
    </div>

    @if(!empty($search_results))
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('post.id') }}</th>
                    <th>{{ trans('post.created_at') }}</th>
                    <th>{{ trans('post.title') }}</th>
                    <th>{{ trans('post.content') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($search_results as $post)
                    <tr>
                        <td><a href="/post/{{ $post->id }}">{{ $post->id }}</a></td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

    <h1 class="page-title">{{trans_choice('post.post', 2)}}</h1>
    @each('includes.post', $posts, 'post')
@stop
