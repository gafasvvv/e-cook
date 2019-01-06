@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
        <div class="col-md-3 mb-4">   
            <form>
            <input type="text" name="name" value="{{ $name }}" placeholder="料理名で検索">
            <input type="submit" value="検索">
            </form>
        </div>
        <div class="col-md-3 offset-1 mb-4">
            <form>
            <input type="text" name="ingredient" value="{{ $ingredient }}" placeholder="材料名で検索">
            <input type="submit" value="検索">
            </form>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="mb-4 text-center">検索結果一覧</h2>
    <div class="row">
        @foreach($recipes as $recipe)
        <div class="col-md-3">
            <img src="https://placehold.jp/200x200.png"></img> 
            <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
            <p>コメント</p>
            <p>{!! nl2br(e($recipe->content)) !!}</p>
            <div>投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
            <div>投稿日時 : {{ $recipe->created_at }}</div>
            <div class="row mt-3 mb-4 mx-auto">
            @if (Auth::id() != $recipe->user_id)
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
            @endif
            </div>
        </div>
         @endforeach
    </div>
    {{ $recipes->render('pagination::bootstrap-4') }}
</div>

@endsection
