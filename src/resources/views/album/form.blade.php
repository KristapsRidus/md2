@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if ($errors->any())
	<div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
@endif
<form
	method="post"
	action="{{ $album->exists ? '/albums/patch/' . $album->id : '/albums/put' }}"
	enctype="multipart/form-data">
	@csrf
	<div class="mb-3">
		<label for="album-name" class="form-label">Nosaukums</label>
		<input
			type="text"
			id="album-name"
			name="name"
			value="{{ old('name', $album->name) }}"
			class="form-control @error('name') is-invalid @enderror"
		>
		@error('name')
			<p class="invalid-feedback">{{ $errors->first('name') }}</p>
		@enderror
	</div>
	<div class="mb-3">
		<label for="album-author" class="form-label">Autors</label>
		<select
			id="album-author"
			name="author_id"
			class="form-select @error('author_id') is-invalid @enderror"
		>
			<option value="">Norādiet autoru!</option>
				@foreach($authors as $author)
					<option
						value="{{ $author->id }}"
						@if ($author->id == old('author_id', $album->author->id ?? false)) selected @endif
					>{{ $author->name }}</option>
				@endforeach
		</select>
		@error('author_id')
			<p class="invalid-feedback">{{ $errors->first('author_id') }}</p>
		@enderror
	</div>
	<div class="mb-3">
		<label for="album-description" class="form-label">Apraksts</label>
		<textarea
			id="album-description"
			name="description"
			class="form-control @error('description') is-invalid @enderror"
		>{{ old('description', $album->description) }}</textarea>
		@error('description')
			<p class="invalid-feedback">{{ $errors->first('description') }}</p>
		@enderror
	</div>
	<div class="mb-3">
		<label for="album-year" class="form-label">Izdošanas gads</label>
		<input
			type="number" max="{{ date('Y') + 1 }}" step="1"
			id="album-year"
			name="year"
			value="{{ old('year', $album->year) }}"
			class="form-control @error('year') is-invalid @enderror"
		>
		@error('year')
			<p class="invalid-feedback">{{ $errors->first('year') }}</p>
		@enderror
	</div>
	
	<div class="mb-3">
		<label for="album-price" class="form-label">Cena</label>
		<input
			type="number" min="0.00" step="0.01" lang="en"
			id="album-price"
			name="price"
			value="{{ old('price', $album->price) }}"
			class="form-control @error('price') is-invalid @enderror"
		>
		@error('price')
			<p class="invalid-feedback">{{ $errors->first('price') }}</p>
		@enderror
	</div>
	
	<div class="mb-3">
		<label for="album-image" class="form-label">Attēls</label>
		@if ($album->image)
			<img
				src="{{ asset('images/' . $album->image) }}"
				class="img-fluid img-thumbnail d-block mb-2"
				alt="{{ $album->name }}"
			>
		@endif
		<input
			type="file" accept="image/png, image/jpeg"
			id="album-image"
			name="image"
			class="form-control @error('image') is-invalid @enderror"
		>
		@error('image')
			<p class="invalid-feedback">{{ $errors->first('image') }}</p>
		@enderror
	</div>

	<div class="mb-3">
		<div class="form-check">
			<input
				type="checkbox"
				id="album-display"
				name="display"
				value="1"
				class="form-check-input @error('display') is-invalid @enderror"
				@if (old('display', $album->display)) checked @endif
			>
			<label class="form-check-label" for="album-display">
				Publicēt ierakstu
			</label>
			@error('display')
				<p class="invalid-feedback">{{ $errors->first('display') }}</p>
			@enderror
		</div>
	</div>
	<button type="submit" class="btn btn-primary">
		{{ $album->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
	</button>
</form>
@endsection