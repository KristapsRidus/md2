@extends('layout')
@section('content')
	<h1>{{ $title }}</h1>
	@if ($errors->any())
		<div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
	@endif
	<form method="post" action="{{ $zanrs->exists ? '/zanri/patch/' . $zanrs->id : '/zanri/put' }}"

		@csrf
		<div class="mb-3">
			<label for="zanrs-name" class="form-label">Žanra nosaukums</label>
			<input
				type="text"
				value="{{ old('name', $zanrs->name) }}"
				class="form-control @error('name') is-invalid @enderror"
				id="zanrs-name"
				name="name">
			@error('name')
				<p class="invalid-feedback">{{ $errors->first('name') }}</p>
			@enderror
		</div>
		<button type="submit" class="btn btn-primary">Pievienot</button>
	</form>
@endsection