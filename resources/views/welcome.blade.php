@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <div class="container">
        <div class=mb-3>
        <h2 class="text-center">新着レシピ</h2>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-5">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mb-5">
                @if ($recipe->photo_url)
                    <img src="{{ $recipe->photo_url }}" style="width: 250px; height: 250px;">
                @else
                    <img src="https://placehold.jp/250x250.png"></img>
                @endif
                <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                <p>ひとこと</p>
                <p>{!! nl2br(e($recipe->content)) !!}</p>
                <div>投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
                <div>投稿日時 : {{ $recipe->created_at }}</div>
                <div class="row mt-3 mx-auto">
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
        @endif
        {{ $recipes->render('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="container">
        <div class=mb-3>
        <h1 class="text-center">新着レシピ</h1>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-5">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mb-5 mx-auto">
                @if ($recipe->photo_url)
                    <img src="{{ $recipe->photo_url }}" style="width: 250px; height: 250px;">
                @else
                    <img src="https://placehold.jp/250x250.png"></img>
                @endif
                <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                <p>ひとこと</p>
                <p>{!! nl2br(e($recipe->content)) !!}</p>
                <div>投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
                <div>投稿日時 : {{ $recipe->created_at }}</div>
            </div>
            @endforeach
        </div>
        @endif
        {{ $recipes->render('pagination::bootstrap-4') }}
    </div>
    @endif
@endsection