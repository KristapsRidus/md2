@extends('layout')
@section('content')
	<h1>{{ $title }}</h1>
	@if (count($items) > 0)
		<table class="table table-striped table-hover table-sm">
			<thead class="thead-light">
				<tr>
					<th>ID</td>
					<th>Žanrs</td>
					<th>&nbsp;</td>
				</tr>
			</thead>
		<tbody>
		@foreach($items as $zanrs)
		<tr>
			<td>{{ $zanrs->id }}</td>
			<td>{{ $zanrs->name }}</td>
			<td><a href="/zanri/update/{{ $zanrs->id }}" class="btn btn-outline-primary btnsm">Labot</a> / 
			<form action="/zanri/delete/{{ $zanrs->id }}" method="post" class="deletionform d-inline">
				{{csrf_field()}}
				<button type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button>
			</form>
			</td>
		</tr>
		@endforeach
		</tbody>
		</table>
		<a href="/zanri/create" class="btn btn-primary">Izveidot jaunu</a>
	@else
		<p>Nav atrasts neviens ieraksts</p>
	@endif
@endsection
