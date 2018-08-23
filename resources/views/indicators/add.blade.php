@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Cadastrar indicador</h3>
    </div>

    {!! Form::open(['url' => 'indicators/save', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}

        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('SQL') !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder'=>'Ex: SELECT * FROM users;']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('name', 'Nome do indicador') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Ex: Total de usuários']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Cor') !!}
                            {!! Form::select('color', [
                                'aqua' => 'Azul',
                                'red' => 'Vermelho',
                                'green' => 'Verde',
                                'warning' => 'Laranja'
                            ], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Link') !!}
                            {!! Form::text('link', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Tamanho') !!}
                            {!! Form::select('size', [ 
                                1 => 1,
                                2 => 2,
                                3 => 3,
                                4 => 4,
                                5 => 5,
                                6 => 6,
                                7 => 7,
                                8 => 8,
                                9 => 9,
                                10 => 10,
                                11 => 11,
                                12 => 12
                            ], 2, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Icon') !!}
                            {!! Form::text('glyphicon', null, ['class' => 'form-control', 'placeholder'=>'glyphicon']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Descrição') !!}
                            {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary bgpersonalizado']) !!}
            </div>
        </div>

    {!! Form::close() !!}

</div>

@endsection