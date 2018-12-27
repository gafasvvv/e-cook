<ul class="media-list">
    @foreach ($recipes as $recipe)
        <li class="media mb-3">
            <div class="media-body ml-3">
                <div class="row">
                    <div class="col-4">
                        <img src="https://placehold.jp/200x200.png"></img>
                        <h3>{!! link_to_route('users.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                    </div>
                    <div class="col-8">
                        {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}
                        <span class="text-muted">投稿日時 {{ $recipe->created_at }}</span>
                        <p>{!! nl2br(e($recipe->content)) !!}</p>
                        @if (Auth::id() == $recipe->user_id)
                            {!! Form::open(['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $recipes->render('pagination::bootstrap-4') }}