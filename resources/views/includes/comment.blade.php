<div id="comment-{{ $comment->id }}" class="panel panel-default">
    <div class="panel-heading">
        <strong>{!! $comment->author !!}</strong>
        <span class="text-muted">
            {{ trans('post.commented') }}
            {{ trans('default.on_date_at_time', [
                    'date' => $comment->created_at->formatLocalized('%A %d %B %Y'),
                    'time' => $comment->created_at->formatLocalized('%H:%M'),
                ])
            }}
        </span>
    </div>
    <div class="panel-body">
        {!! $comment->content !!}
    </div>
</div>
