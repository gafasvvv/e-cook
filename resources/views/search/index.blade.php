@extends('layouts.app')

@section('content')

    <div class="container">
       <div class="row">
            <div class="col-md-3 mb-4">   
                <form class="form-inline">
                    <div class="form-group">
                    <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="料理名か材料名を入力">
                    <input type="submit" value="検索" class="btn btn-outline-info ml-3">
                    </div>
                </form>
            </div>
        </div>
    </div
         {{--{{ dump($datas) }} --}}
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
                <!--<div>投稿日時 : {{ $recipe->created_at }}</div>-->
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
    </div>
    @endif
    <div class="col-sm-8" style="text-align:right;">
        <div class="paginate">
            {!! $recipes->appends(['keyword' => $keyword])->render() !!}
        </div>
    </div>
@endsection
