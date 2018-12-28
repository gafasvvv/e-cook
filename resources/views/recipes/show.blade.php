@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 mb-3">
                <h2>{{ $recipe->name }}</h2>
            </div>
            <div class="col-7 offset-1 mb-3">
                <h3>{{ $recipe->content }}</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 mb-3">
                <img src="https://placehold.jp/200x200.png"></img>
            </div>
            <div class="col-8 mb-3">
                <h4>材料(2人分)</h4>
                <div class="row">
                    <div class="col-md-8">
                        
                        <h4>材料・調味料名</h4>
                        @foreach ($ingredients as $ingredient)
                        <div>
                        {{ $ingredient->ingredient }}
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
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
        <div>
       {{ $how_to->how_to_make }}
       </div>
        @endforeach
    </div>
    @if (Auth::id() == $recipe->user_id)
    <div class="container">
        <div class="row">
            <div class="mx-auto mt-3 mb-3">
            {!! link_to_route('recipes.edit', '編集', ['id' => $recipe->id], ['class' => 'btn btn-primary btn-lg']) !!}
            </div>
        </div>
        <div class="row">
            <div class="mx-auto mb-3">
            {{-- {!! Form::model($recipe, ['route' => 'recipes.destroy', $recipe->id], 'method'=> 'delete']) !!} --}}
                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-lg']) !!}
            {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
    @endif
@endsection