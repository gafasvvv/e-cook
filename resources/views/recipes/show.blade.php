@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>レシピ名</label>
                <h2>{{ $recipe->name }}</h2>
            </div>
            <div class="col-md-7 offset-md-1 mb-3">
                <label>ひとこと</label>
                <h3>{{ $recipe->content }}</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                @if ($recipe->photo_url)
                    <img src="{{ $recipe->photo_url }}" style="width: 300px; height: 300px;">
                @else
                    <img src="https://placehold.jp/300x300.png"></img>
                @endif
                @if (Auth::id() == $recipe->user_id)
                {!! Form::open(['route' => ['uploadcontent.upload', $recipe->id], 'method' => 'post', 'class' => 'form', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('myfile', 'レシピ画像を追加してください') !!}
                    {!! Form::file('myfile', null) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('追加') !!}
                </div>
                
                {!! Form::close() !!}
                @endif
            </div>
            <div class="col-md-8 mb-3">
                <h4>材料(2人分)</h4>
                <div class="row">
                    <div class="col-6">
                        <h4>材料・調味料名</h4>
                        @foreach ($ingredients as $ingredient)
                        <div>
                           {{ $ingredient->ingredient }}
                        </div>
                        @endforeach
                    </div>
                    <div class="col-6">
                        <h4>分量</h4>
                        @foreach ($ingredients as $ingredient)
                        <div>
                            {{ $ingredient->quantity }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h4>作り方</h4>
        @foreach ($how_tos as $how_to)
        <ul>
           <li>{{ $how_to->how_to_make }}</li>
       </ul>
        @endforeach
    </div>
    @if (Auth::id() == $recipe->user_id)
    <div class="container">
        <div class="row">
            <div class="mx-auto mt-3 mb-3">
            {!! link_to_route('recipes.edit', '編集', ['id' => $recipe->id], ['class' => 'btn btn-outline-info btn-lg']) !!}
            </div>
        </div>
        <div class="row">
            <div class="mx-auto mb-3">
            {!! Form::model($recipe, ['route' => ['recipes.destroy', $recipe->id], 'method'=> 'delete']) !!} 
                {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-lg']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif
@endsection