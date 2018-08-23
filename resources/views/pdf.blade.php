<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$report->name}}</title>

	<style>
		table, th, td{
			border: solid 1px #ccc;
			font-size: 12px;
			text-align: center;
		}
	</style>
</head>
<body>
		
	<div style="text-align: center;">
		<img src="{{ URL('/') }}/img/{{$report->image}}" width="50">
		<h3>{{$report->name}}</h3>
	</div>

    <table>
		<thead>
			<tr>
				@foreach($columns as $key)
					<th>{{$key}}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($query as $column)
				<tr>
					@php
						$column = array_values((array)$column);
						echo '<td>' . implode('</td><td>', $column) . '</td>';
					@endphp
				</tr>
			@endforeach
		</tbody>
	</table>
	
</body>
</html>