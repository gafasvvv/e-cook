<ul class="media-list">
    @foreach ($favorites as $favorite)
        <li class="media mb-3">
            <div class="media-body ml-3">
                <div class="row">
                    <div class="col-6">
                        <img src="https://placehold.jp/200x200.png"></img>
                        <h3>{!! link_to_route('recipes.show', $favorite->name, ['id' => $favorite->id]) !!}</h3>
                    </div>
                    <div class="col-6">
                        {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user->id]) !!}
                        <span class="text-muted">投稿日時 {{ $favorite->created_at }}</span>
                        <p>{!! nl2br(e($favorite->content)) !!}</p>
                        <div class="row">
                            <div class="col-6 mx-auto">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
