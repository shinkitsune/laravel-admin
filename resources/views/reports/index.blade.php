@extends('layouts.app')

@section('content')

<div class="box">
    
    <div class="box-header">
        <h3 class="box-title">Relatórios</h3>
    </div>

    <div class="box-body table-responsive">

        <table id="datatable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Relatório</th>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Tamanho da fonte</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($reports as $value)

                <tr>
                    <td> {{$value->id}} </td>

                    <td> {{$value->name}} </td>
                    
                    <td> 
                        @if($value->image)
                            <a class="fancybox" rel="gallery1" target="_blank" href="images/{{$value->image}}">
                                <img src="images/{{$value->image}}" width="30">
                            </a>
                        @endif
                    </td>

                    <td> {{$value->description}} </td>
                                        
                    <td> {{$value->size}} </td>
                    
                    <td>

                        <a href="{{ URL('/') }}/reports/generate/{{$value->id}}" alt="Gerar relatório" title="Gerar relatório" class="btn btn-default">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </a>

                        <a href="{{ URL('/') }}/reports/edit/{{$value->id}}" alt="Editar" title="Editar" class="btn btn-default">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <form action="{{ URL('/') }}/reports/delete" method="POST">
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
            <a href="{{ URL('/') }}/reports/add" class="btn btn-primary bgpersonalizado">Cadastrar</a>
        </div>

    </div>

</div>

@endsection