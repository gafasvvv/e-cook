@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    @if (Auth::id() == $user->id)
                    {!! Form::open(['route' => ['profile.upload',$user->id], 'method' => 'post', 'class' => 'form', 'files' => true]) !!}
                    {{--成功メッセージ--}}
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="form-group">
                        @if ($user->avatar_url)
                        <p class="text-center">
                            <img src="{{ $user->avatar_url }}" style="width: 300px; height: 300px;">
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
                    @endif
                </div>
            </div>
        </aside>
        <div class="col-md-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" 
                class-"nav-link {{ Request::is('users/' . $user->id) ? 'active' : ''}}">個人レシピ
                <span class="badge badge-secondary ml-2 mb-2 mr-2">{{ $count_recipes }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.favorites', ['id' => $user->id]) }}" 
                class-"nav-link {{ Request::is('users/*/favorites') ? 'active' : ''}}">お気に入り
                <span class="badge badge-secondary ml-2 mb-2 mr-2">{{ $count_favorites }}</span></a></li>
            </ul>
            @if (count($recipes) > 0)
                @include('users.recipes', ['recipes'=> $recipes])
            @endif
        </div>
    </div>
@endsection