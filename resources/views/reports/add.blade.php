@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Cadastrar relatório</h3>
    </div>

    {!! Form::open(['url' => 'reports/save', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}

        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Relatório') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Ex: Total de usuários']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Imagem') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Descrição') !!}
                            {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('query', 'Script para o relatório') !!}
                            {!! Form::text('query', null, ['class' => 'form-control', 'placeholder'=>'Ex: SELECT * FROM users;']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('size', 'Tamanho da fonte') !!}
                            {!! Form::text('size', null, ['class' => 'form-control']) !!}
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