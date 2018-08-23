@extends('layouts.app')

@section('content')

<div class="box">
    
    <div class="box-header">
        <h3 class="box-title">Indicadores</h3>
    </div>

    <div class="box-body table-responsive">

        <table id="datatable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Indicador</th>
                    <th>Cor</th>
                    <th>Tamanho</th>
                    <th>Icon</th>
                    <th>Link</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($indicators as $value)

                <tr>
                    <td> {{$value->id}} </td>

                    <td> {{$value->name}} </td>
                    
                    <td> {{$value->color}} </td>

                    <td> {{$value->size}} </td>
                    
                    <td> {{$value->glyphicon}} </td>
                    
                    <td> {{$value->link}} </td>
                    
                    <td>

                        <a href="{{ URL('/') }}/indicators/edit/{{$value->id}}" alt="Editar" title="Editar" class="btn btn-default">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <form action="{{ URL('/') }}/indicators/delete" method="POST">
                            {!! csrf_field() !!}
                            {!! Form::hidden('id', $value->id) !!}
                            <button type="submit" class="btn btn-default">
                               <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <br><br>

        <div class="form-group text-right">
            <a href="{{ URL('/') }}/indicators/add" class="btn btn-primary bgpersonalizado">Cadastrar</a>
        </div>

    </div>

</div>

@endsection