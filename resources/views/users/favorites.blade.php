@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}
                    {{--成功メッセージ--}}
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="form-group">
                        @if ($user->avatar_filename)
                        <p class="text-center">
                            <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar" />
                        </p>
                        @else
                        <img class="media-object rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                        @endif
                        {!! Form::label('file', '推奨サイズ200px*200px' , ['class' => 'control-labelse']) !!}
                        {!! Form::file('file') !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::submit('アップロード' , ['class' => 'btn btn-outline-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    {{--<img class="media-object rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">--}}
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" 
                class-"nav-link {{ Request::is('users/' . $user->id) ? 'active' : ''}}">個人レシピ</a></li>
                <li class="nav-item"><a href="{{ route('users.favorites', ['id' => $user->id]) }}" 
                class-"nav-link {{ Request::is('users/*/favorites') ? 'active' : ''}}">お気に入り</a></li>
            </ul>
            <ul class="media-list">
                @foreach ($favorites as $favorite)
                <li class="media mb-3">
                    <div class="media-body ml-3">
                        <div class="row">
                            <div class="col-6">
                                <img src="https://placehold.jp/200x200.png"></img>
                                <h3>{!! link_to_route('recipes.show', $favorite->name, ['id' => $favorite->id]) !!}</h3>
                            </div>
                            <div class="col-6">
                                {!! link_to_route('users.show', $favorite->user->name, ['id' => $favorite->user->id]) !!}
                                <span class="text-muted">投稿日時 {{ $favorite->created_at }}</span>
                                <p>{!! nl2br(e($favorite->content)) !!}</p>
                                <div class="row">
                                    <div class="col-6 mx-auto">
                                    @if (Auth::id() != $favorite->id)
                                        @if (Auth::user()->is_favorite($favorite->id))
                                            {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('お気に入り解除', ['class' => "btn btn-outline-danger btn-block"]) !!}
                                            {!! Form::close() !!}
                                        @else
                                            {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                                                {!! Form::submit('お気に入り追加', ['class' => "btn btn-outline-success btn-block"]) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection