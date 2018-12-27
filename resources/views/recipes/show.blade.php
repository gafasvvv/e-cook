@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    {{ $recipe->name }}
                </div>
            </div>
            <div class="col-6 offset-3">
                <div class="form-group">
                    {{ $recipe->content }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img src="https://placehold.jp/200x200.png"></img>
            </div>
            <div class="col-8">
                <h3>材料(2人分)</h3>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <h3>材料・調味料名</h3>
                                
                                {{ $recipe->ingredient }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <h3>分量</h3>
                            {{ $recipe->quantity }}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>作り方</h3>
        <div class="row">
            <div class="col-md-3">
                {{ $recipe->how_to_make }}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
            {{--{!! Form::open(['route' => 'recipes.edit']) !!}--}}
                {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
            {{--{!! Form::close() !!}--}}
            </div>
            <div class="col-12">
            {{-- {!! Form::open(['route' => 'recipes.destroy']) !!} --}}
                {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@endsection