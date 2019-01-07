@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                {!! Form::open(['route' => 'recipes.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'レシピ名') !!}
                    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6 offset-md-2">
                <div class="form-group">
                    {!! Form::label('content', 'ひとこと') !!}
                    {!! Form::text('content', null, ['class'=> 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>材料(2人分)</h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('ingredient', '材料・調味料名') !!}
                    <?php
                        for($i = 0; $i <= 7; $i++){
                        ?>
                            {!! Form::text("ingredients[$i][ingredient]", null, ['class'=> 'form-control']) !!}
                    <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                            {!! Form::label('quantity', '分量') !!}
                    <?php
                        for($i = 0; $i <= 7; $i++){
                        ?>
                            {!! Form::text("ingredients[$i][quantity]", null, ['class'=> 'form-control']) !!}
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>作り方</h3>
        <div class="row">
            <?php
                for($i = 0; $i <= 7; $i++){
            ?>
            <div class="col-md-3 mb-3">
                {!! Form::label('how_to_make', $i+1) !!}
                {!! Form::textarea("how_tos[$i][how_to_make]", null, ['class'=> 'form-control']) !!}
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="mx-auto mt-3 mb-3">
                {!! Form::submit('投稿', ['class' => 'btn btn-outline-info btn-lg']) !!}
            </div>
        </div>
    </div>
                {!! Form::close() !!}

@endsection