@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
            {!! Form::model($recipe, ['route' => ['recipes.update', $recipe->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'レシピ名') !!}
                    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="col-6 offset-3">
                <div class="form-group">
                    {!! Form::label('content', 'おすすめポイント') !!}
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
                            
                        <?php 
                           if(isset($ingredients[$i])){ // $ingredientsに$iが存在するかを確認している
                        ?>
                            {!! Form::text("ingredients[$i][ingredient]", $ingredients[$i]['ingredient'], ['class'=> 'form-control']) !!}
                        <?php
                           } else { // $iが存在しない＝内容がからの場合は第二引数をnullにしている
                        ?>
                            {!! Form::text("ingredients[$i][ingredient]", null, ['class'=> 'form-control']) !!}
                        <?php
                           }
                        ?>
                            <?php } ?>
                        </div>
                    </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('quantity', '分量') !!}
                    <?php
                        for($i = 0; $i <= 7; $i++){
                    ?>
                    <?php 
                        if(isset($ingredients[$i])){ // $ingredientsに$iが存在するかを確認している
                    ?>
                        {!! Form::text("ingredients[$i][quantity]", $ingredients[$i]['quantity'], ['class'=> 'form-control']) !!}
                    <?php
                        } else { // $iが存在しない＝内容がからの場合は第二引数をnullにしている
                    ?>
                        {!! Form::text("ingredients[$i][quantity]", null, ['class'=> 'form-control']) !!}

                    <?php
                        }
                    ?>
                        <?php } ?>
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
            <div class="col-md-3">
                {!! Form::label('how_to_make', $i+1) !!}
                <?php 
                    if(isset($how_tos[$i])){ // $how_tosに$iが存在するかを確認している
                ?>
                    {!! Form::textarea("how_tos[$i][how_to_make]", $how_tos[$i]['how_to_make'], ['class'=> 'form-control']) !!}
                <?php
                    } else { // $iが存在しない＝内容がからの場合は第二引数をnullにしている
                ?>
                    {!! Form::textarea("how_tos[$i][how_to_make]", null, ['class'=> 'form-control']) !!}
                <?php
                    }
                ?>
             </div>
                <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="mx-auto mt-3 mb-3">
                {!! Form::submit('更新', ['class' => 'btn btn-outline-dark btn-block']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection