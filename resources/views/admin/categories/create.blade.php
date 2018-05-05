@extends('layouts.admin')

@section('title', 'Create A New Category')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Create New Categories</h2>
</div>

<form action="{{ route('categories.store') }}" method="post">
	@csrf
	<div class="row">
		<div class="col-md-6 offset-3">

			<div class="form-group">
				<label for="name">Tag Name</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save New Category</button>
				<a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>

		</div>
		
	</div>
</form>

@endsection