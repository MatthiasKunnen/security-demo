@extends('layouts.default')

@section('title', $post->title)

@section('content')
    <div id="post-{{ $post->id }}" class="post">
        <div>
            <h2 class="post-title">{!! $post->title !!}</h2>
            <span class="post-author text-muted display-block">
                {{ trans('default.by') }} <strong>{{ $post->author }}</strong>
                {{ trans('default.on_date_at_time', [
                        'date' => $post->created_at->formatLocalized('%A %d %B %Y'),
                        'time' => $post->created_at->formatLocalized('%H:%M'),
                    ])
                }}
            </span>
        </div>
        <p class="post-content">
            {!! $post->content !!}
        </p>
    </div>

    @each('includes.comment', $post->comments, 'comment', 'includes.comments-empty')

    @if(Auth::check())
        <form class="form new-comment" action="/post/{{$post->id}}/" method="post">
            <div class="form-group">
                <label class="sr-only" for="new-comment-input">
                    {{ trans('post.add_comment') }}
                </label>
                <textarea id="new-comment-input" class="form-control textarea-auto-size"
                          placeholder="{{ trans('post.something_interesting') }}"
                          name="content" rows="3" maxlength="300" required></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button class="btn btn-default btn-block btn-primary">
                {{ trans('default.submit') }}
            </button>
        </form>
    @endif
@stop
