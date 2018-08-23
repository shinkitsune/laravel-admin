@extends('layouts.app')

@section('content')

    <section class="content">

        <div class="page-header">
            <div class="jumbotron">
                <h2>
                    <p><p>Seja bem-vindo(a)!</p></p>
                </h2>
            </div>
        </div>

        <div class="row">
			
			@if(true)
				
				@php
					$indicadores = \App\Indicators::all();
				@endphp

				@foreach($indicadores as $key => $value)
					
					@php

						$result = $cards = DB::select($value->query);

						$count = current($result[0]); 

					@endphp			

					<div class="col-md-{{$value->size}} col-sm-{{($value->size * 2)}} col-xs-{{($value->size * 4)}}">
						<div class="info-box">
							<span class="info-box-icon bg-{{$value->color}}"><i class="{{$value->glyphicon}}"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">{{$value->title}}</span>
								<span class="info-box-number">{{$count}}</span>
								
								@if($value->link != '')
									<a href="{{$value->link}}" target="_blank">
								@endif
								
								<p>{{$value->name}}</p>
								
								@if($value->link != '')
									</a>
								@endif


							</div>
						</div>
					</div>
				
				@endforeach

			@endif

		</div>
        
    </section>

@endsection