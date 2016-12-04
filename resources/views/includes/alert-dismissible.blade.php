<div class="alert alert-{{ $type }} alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @if(is_array($message))
        <ul>
            @foreach($message as $messagePart)
                <li>{!! $messagePart !!}</li>
            @endforeach
        </ul>
    @else
        {!! $message !!}
    @endif
</div>
