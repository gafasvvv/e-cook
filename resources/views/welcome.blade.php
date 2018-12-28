@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-left mb-3">いいねランキング</h1>
        <div class="row mb-5 mx-auto">
            <div class="col-md-4">
                <h2 class="text-left">No.1</h2>
                <img src="https://placehold.jp/200x200.png"></img> 
                <h3 class="text-center">recipe title</h3>
            </div>
            <div class="col-md-4">
                <h2 class="text-left">No.2</h2>
                <img src="https://placehold.jp/200x200.png"></img>  
                <h3 class="text-center">recipe title</h3>
            </div>
            <div class="col-md-4">
                <h2 class="text-left">No.3</h2>
                <img src="https://placehold.jp/200x200.png"></img> 
                <h3 class="text-center">recipe title</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class=mb-3>
        <h1 class="text-left">新着レシピ</h1>
        </div>
        @if(count($recipes) > 0)
        <div class="row mb-5">
            @foreach($recipes as $recipe)
            <div class="col-md-3 mb-5 mx-auto">
                <img src="https://placehold.jp/200x200.png"></img> 
                <h3 class="text-center">{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
            </div>
            @endforeach
        </div>
        @endif
        {{ $recipes->render('pagination::bootstrap-4') }}
    </div>
@endsection