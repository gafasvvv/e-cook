<!--<ul class="media-list">-->
    @foreach ($recipes as $recipe)
        <li class="media mb-3">
            <div class="media-body  pl-3 bg-light rounded">
                <div class="row">
                    <div class="col-md-6 pt-3 pb-3">
                        @if ($recipe->photo_url)
                            <img src="{{ $recipe->photo_url }}" style="width: 250px; height: 250px;"  class="rounded mx-auto d-block">
                        @else
                            <img src="https://placehold.jp/250x250.png"  class="rounded mx-auto d-block"></img>
                        @endif
                    </div>
                    <div class="col-md-6 pt-4">
                        <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                        <h4 class="mt-3">{!! nl2br(e($recipe->content)) !!}</h4>
                        <div class="mt-3">投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
                        <div>投稿日時 : {{ $recipe->created_at }}</div>
                        @if (Auth::id() == $recipe->user_id)
                        <div class="row pr-3">
                            <div class="col-md-6 mt-3">
                            {!! link_to_route('recipes.edit', '編集', ['id' => $recipe->id], ['class' => 'btn btn-outline-info btn-block']) !!}
                            </div>
                            <div class="col-md-6 mt-3">
                            {!! Form::model($recipe, ['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-block']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-6 mx-auto mt-3">
                            @if (Auth::id() != $recipe->id)
                                @if (Auth::user()->is_favorite($recipe->id))
                                {!! Form::open(['route' => ['favorites.unfavorite', $recipe->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('お気に入り解除', ['class' => "btn btn-outline-danger btn-block"]) !!}
                                {!! Form::close() !!}
                                @else
                                {!! Form::open(['route' => ['favorites.favorite', $recipe->id]]) !!}
                                    {!! Form::submit('お気に入り追加', ['class' => "btn btn-outline-success btn-block"]) !!}
                                {!! Form::close() !!}
                                 @endif
                            @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $recipes->render('pagination::bootstrap-4') }}