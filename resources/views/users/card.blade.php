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
                @endif
                {!! Form::label('file', '推奨サイズ200px*200px' , ['class' => 'control-labelse']) !!}
                {!! Form::file('file') !!}
            </div>
                    
            <div class="form-group">
                {!! Form::submit('アップロード' , ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        {{--<img class="media-object rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">--}}
    </div>
</div>