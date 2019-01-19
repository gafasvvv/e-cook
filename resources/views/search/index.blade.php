@extends('layouts.app')

@section('content')

    <div class="container">
       <div class="row">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" name="name" value="{{ $name }}" class="form-control"
                    placeholder="料理名">または
                    <input type="text" name="ingredient" value="{{ $ingredient }}" class="form-control"
                    placeholder="材料名を入力">
                </div>
                <input type="submit" value="検索" class="btn btn-outline-info ml-3">
            </form>
        </div>
    </div
    @if (Auth::check())
    <div class="container">
        <div class="mt-3 mb-3">
            <h2 class="text-center text-secondary">検索結果</h2>
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
    @endif
@endsection
