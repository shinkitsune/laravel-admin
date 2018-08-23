@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Cadastrar perfil</h3>
    </div>

    {!! Form::open(['url' => 'profiles/save', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}

        <div class="box-body">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Nome') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! Form::Label('admin', 'O usuário com este perfil tem acesso de administrador neste sistema?') !!}
                    {!! Form::select('administrator', [ 0 => 'Não', 1 => 'Sim' ], null, ['class' => 'form-control col-md-2']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! Form::Label('master', 'O usuário com este perfil pode ver registros de outros usuários?') !!}
                    {!! Form::select('moderator', [ 0 => 'Não', 1 => 'Sim' ], null, ['class' => 'form-control col-md-2']) !!}
                </div>
            </div>

            <div class="form-group text-right">
                {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary bgpersonalizado']) !!}
            </div>
        </div>

    {!! Form::close() !!}

</div>

@endsection