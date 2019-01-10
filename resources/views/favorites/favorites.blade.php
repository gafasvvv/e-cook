<!--<ul class="media-list">-->
    @foreach ($favorites as $favorite)
        <li class="media mb-3">
            <div class="media-body pl-3 bg-light rounded">
                <div class="row">
                    <div class="col-md-6 pt-3 pb-3">
                        @if ($favorite->photo_url)
                            <img src="{{ $favorite->photo_url }}" style="width: 250px; height: 250px;"  class="rounded mx-auto d-block">
                        @else
                            <img src="https://placehold.jp/250x250.png" class="rounded mx-auto d-block">
                        @endif
                    </div>
                    <div class="col-md-6 pt-4">
                        <h3>{!! link_to_route('recipes.show',$favorite->name, ['id' => $favorite->id]) !!}</h3>
                        <h4 class="mt-3">{!! nl2br(e($favorite->content)) !!}</h4>
                        <div class="mt-3">投稿者 : {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user->id]) !!}</div>
                        <div>投稿日時 : {{ $favorite->created_at }}</div>
                        <div class="row">
                            <div class="col-md-6 mx-auto mt-3">
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