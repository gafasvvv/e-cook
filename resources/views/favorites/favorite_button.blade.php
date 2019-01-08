@if (Auth::id() != $favorite->id)
    @if (Auth::user()->is_favorite($favorite->id))
        {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入り解除', ['class' => "btn btn-outline-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
            {!! Form::submit('お気に入り追加', ['class' => "btn btn-outline-success btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif
