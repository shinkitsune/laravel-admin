@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Editar relatório</h3>
    </div>

    {!! Form::open(['url' => 'reports/update', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}

        <div class="box-body">

            {!! Form::hidden('id', $reports->id) !!}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Relatório') !!}
                            {!! Form::text('name', $reports->name, ['class' => 'form-control', 'placeholder'=>'Ex: Total de usuários']) !!}
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
                            {!! Form::text('description', $reports->description, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('query', 'Script para o relatório') !!}
                            {!! Form::text('query', $reports->query, ['class' => 'form-control', 'placeholder'=>'Ex: SELECT * FROM users;']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('size', 'Tamanho da fonte') !!}
                            {!! Form::text('size', $reports->size, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary bgpersonalizado']) !!}
            </div>
        </div>

    {!! Form::close() !!}

</div>

@endsection