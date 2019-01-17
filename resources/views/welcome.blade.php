@extends('layouts.app')

@section('content')

    @if (Auth::check())
    <div class="container">
        <div class="mt-3 mb-3">
            <h2 class="text-center text-danger">お気に入りBEST3</h2>
        </div>
        <div class="row bg-light mb-5 rounded">
            @foreach($rankings as $ranking)
            <div class="col-md-4 mt-3 mb-3 text-center">
                <div>
                @if ($ranking->photo_url)
                    <img src="{{ $ranking->photo_url }}" style="width: 250px; height: 250px;" class="rounded">
                @else
                    <img src="https://placehold.jp/250x250.png" class="rounded"></img>
                @endif
                <h4 class="mt-3">{{ 'お気に入り数:'.$ranking->count  }}</h4>
                <h3 class="mt-3">{!! link_to_route('recipes.show', $ranking->name, ['id' => $ranking->recipe_id]) !!}</h3>
                <h4>{!! nl2br(e($ranking->content)) !!}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="mt-3 mb-3">
            <h2 class="text-center text-secondary">新着レシピ</h2>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-3 bg-light rounded">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mt-3 mb-3 text-center">
                @if ($recipe->photo_url)
                    <img src="{{ $recipe->photo_url }}" style="width: 250px; height: 250px;" class="rounded">
                @else
                    <img src="https://placehold.jp/250x250.png" class="rounded"></img>
                @endif
                <h3 class="mt-3">{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id,]) !!}</h3>
                <h4 class="mt-2">{!! nl2br(e($recipe->content)) !!}</h4>
                <div class="text-left">投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
                <div class="text-left">投稿日時 : {{ $recipe->created_at }}</div>
                <div class="row mt-3 mx-auto d-block">
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
        <div class="mt-3 mb-3">
            <h2 class="text-center text-danger">お気に入りBEST3</h2>
        </div>
        <div class="row bg-light mb-5 rounded">
            @foreach($rankings as $ranking)
            <div class="col-md-4 mt-3 mb-3 text-center">
                <div>
                @if ($ranking->photo_url)
                    <img src="{{ $ranking->photo_url }}" style="width: 250px; height: 250px;" class="rounded">
                @else
                    <img src="https://placehold.jp/250x250.png" class="rounded"></img>
                @endif
                <p class="mt-3">{{ 'お気に入り数:'.$ranking->count  }}</p>
                <h3 class="mt-3">{!! link_to_route('recipes.show', $ranking->name, ['id' => $ranking->recipe_id]) !!}</h3>
                <h4>{!! nl2br(e($ranking->content)) !!}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="mt-3 mb-3">
            <h2 class="text-center text-secondary">新着レシピ</h2>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-3 bg-light rounded">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mt-3 mb-3 text-center">
                @if ($recipe->photo_url)
                    <img src="{{ $recipe->photo_url }}" style="width: 250px; height: 250px;" class="rounded">
                @else
                    <img src="https://placehold.jp/250x250.png" class="rounded"></img>
                @endif
                <h3 class="mt-3">{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                <h4 class="mt-2">{!! nl2br(e($recipe->content)) !!}</h4>
                <div class="text-left">投稿者 : {!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</div>
                <div class="text-left">投稿日時 : {{ $recipe->created_at }}</div>
            </div>
            @endforeach
        </div>
        @endif
        {{ $recipes->render('pagination::bootstrap-4') }}
    </div>
    @endif
    
@endsection