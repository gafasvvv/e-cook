@extends('layouts.app')

@section('content')

    @if (Auth::check())
    <div class="container">
        <div class="mt-3 mb-3">
            <h2 class="text-center text-danger">お気に入りランキング</h2>
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
        {{ $rankings->render('pagination::bootstrap-4') }}
    </div>
    @endif
    
@endsection