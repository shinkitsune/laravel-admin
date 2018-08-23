@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Dados de acesso</h3>
    </div>

    {!! Form::open(['url' => 'perfil', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8']) !!}

        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text">
                            {!! Form::label('Nome') !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input email required">
                            {!! Form::label('E-mail') !!}
                            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        
            @if($user->image)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input text required">    
                                <img src="{{ URL('/') }}/images/{{$user->image}}" width="100">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input file">
                            {!! Form::label('image', 'Foto do perfil') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text required">
                            {!! Form::label('Profissão') !!}
                            {!! Form::text('profession', $user->profession, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text required">
                            {!! Form::label('Perfil') !!}
                            {!! Form::select('profile_id', $profiles, $user->profile_id, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input text required">
                            {!! Form::label('Usuário') !!}
                            {!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input password">
                            {!! Form::label('Senha') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="form-group text-right">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary bgpersonalizado']) !!}
            </div>
        </div>

    {!! Form::close() !!}

</div>

@endsection