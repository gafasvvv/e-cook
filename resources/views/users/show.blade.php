@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="media-object rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-9">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="#" class-"nav-link">新着レシピ</a></li>
                <li class="nav-item"><a href="#" class-"nav-link">いいね</a></li>
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" 
                class-"nav-link {{ Request::is('users/' . $user->id) ? 'active' : ''}}">個人レシピ</a></li>
            </ul>
            @if (count($recipes) > 0)
                @include('recipes.recipes', ['recipes'=> $recipes])
            @endif
        </div>
    </div>
@endsection