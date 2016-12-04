<div class="post">
    <div>
        <h2 class="post-title">{!! $post->title !!}</h2>
        <a href="/post/{{$post->id}}" class="post-view-comments">{{trans('post.view_comments')}}</a>
        <span class="text-muted display-block post-author">
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
