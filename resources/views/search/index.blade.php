@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
       <div class="col-md-3 mb-3">
        {!! Form::open(['method' => 'GET']) !!}
            {!! Form::text('s', null) !!}
            {!! Form::submit('検索', ['class' => 'btn btn-outline-success my-2 my-sm-0']) !!}
        {!! Form::close() !!}
        </div>
    </div>
</div>
 
<div class="container">
    <div class="row">
        @foreach($data as $recipe)
        <div class="col-md-3">
            <img src="https://placehold.jp/200x200.png"></img> 
            <h3>{!! link_to_route('recipes.show', $recipe->name, ['id' => $recipe->id]) !!}</h3>
        </div>
         @endforeach
    </div>
</div>

@endsection
