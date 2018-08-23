@extends('layouts.app')

@section('content')

<div class="box">
    
    <div class="box-header">
        <h3 class="box-title">Logs</h3>
    </div>

    <div class="box-body table-responsive">

        <table id="datatable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Log</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($logs as $value)

                <tr>
                
                    <td> {{$value->id}} </td>

                    <td> {{$value->description}} </td>

                    <td> {{ date('d/m/Y H:i:s', strtotime($value->created_at)) }} </td>
                    
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection