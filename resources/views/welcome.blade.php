@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <div class="container">
        <h1 class="text-center mb-3">お気に入りランキング</h1>
        <div class="row mb-5 mx-auto">
            <div class="col-md-4">
                <h2 class="text-left">No.1</h2>
                <img src="https://placehold.jp/200x200.png"></img> 
                <h3 class="text-left">recipe title</h3>
            </div>
            <div class="col-md-4">
                <h2 class="text-left">No.2</h2>
                <img src="https://placehold.jp/200x200.png"></img>  
                <h3 class="text-left">recipe title</h3>
            </div>
            <div class="col-md-4">
                <h2 class="text-left">No.3</h2>
                <img src="https://placehold.jp/200x200.png"></img> 
                <h3 class="text-left">recipe title</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class=mb-3>
        <h1 class="text-center">新着レシピ</h1>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-5">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mb-5">
                <img src="https://placehold.jp/200x200.png"></img>
                <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                <p>投稿者:{!! link_to_route('users.show', $recipe->user->name, ['id' => $recipe->user->id]) !!}</p>
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
                <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
                <img src="https://placehold.jp/200x200.png"></img>
            </div>
            @endforeach
        </div>
        @endif
        {{ $recipes->render('pagination::bootstrap-4') }}
    </div>
    @endif
@endsection