<ul class="media-list">
    @foreach ($recipes as $recipe)
        <li class="media mb-3">
            <div class="media-body ml-3">
                <div class="row">
                    <div class="col-6">
                        <img src="https://placehold.jp/200x200.png"></img>
                        <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                    </div>
                    <div class="col-6">
                        {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}
                        <span class="text-muted">投稿日時 {{ $recipe->created_at }}</span>
                        <p>{!! nl2br(e($recipe->content)) !!}</p>
                        @if (Auth::id() == $recipe->user_id)
                        <div class="row">
                            <div class="col-6">
                            {!! link_to_route('recipes.edit', '編集', ['id' => $recipe->id], ['class' => 'btn btn-info btn-block']) !!}
                            </div>
                            <div class="col-6">
                            {!! Form::model($recipe, ['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-6 mx-auto">
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