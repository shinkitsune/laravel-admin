@extends('layouts.app')

@section('content')

<div class="box">

    <div class="box-header">
        <h3 class="box-title">Permissões de acesso (Módulos/Ações)</h3>
    </div>

    <div class="box-body">
        
        {!! Form::open(['url' => 'permissions/save', 'method' => 'post']) !!}

        <input type="hidden" name="id" value="{{$user->id}}">
            
        <div class="col-md-12">

            @foreach($lista as $key => $value)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">

                            <?php 
                           
                                $label = str_replace('App\Http\Controllers', '', $value);

                                $label = explode('Controller@', $label);

                                if(!isset($modulo) or (isset($modulo) && $modulo != $label[0]))
                                {   
                                    $modulo = $label[0];

                                    echo '<h4>' . $modulo . '</h4>';
                                }

                                switch ($label[1]) {

                                    case 'index':
                                        $label[1] = 'Listar'; 
                                        break;
                                    
                                    case 'edit':
                                        $label[1] = 'Visualizar tela edição';
                                        break;

                                    case 'create':
                                        $label[1] = 'Visualizar tela de cadastro';
                                        break;

                                    case 'store':
                                        $label[1] = 'Cadastrar';
                                        break;

                                    case 'update':
                                        $label[1] = 'Editar';
                                        break;

                                    case 'destroy':
                                        $label[1] = 'Deletar';
                                        break;

                                    case 'show':
                                        $label[1] = 'Visualizar';
                                        break;

                                    case 'perfil':
                                        $label[1] = 'Editar próprio perfil';
                                        break;

                                    case 'defaultProfile':
                                        $label[1] = 'Mudar perfil padrão';
                                        break;
                                }
                            ?>

                            <li>

                                @if (in_array($value, $perms->toArray()))
                                    {!! Form::checkbox('permissions[]', $value, true) !!} {{$label[1]}} <br>
                                @else
                                    {!! Form::checkbox('permissions[]', $value, false) !!} {{$label[1]}} <br>
                                @endif

                            </li>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="form-group text-right">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary bgpersonalizado']) !!}
        </div>

        {!! Form::close() !!}

    </div>
   
</div>

@endsection