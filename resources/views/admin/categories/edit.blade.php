@extends('layouts.admin')

@section('title', "Edit Tag $category->name")

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Edit Category <i class="fa fa-arrow-right"></i> {{ $category->name }}</h2>
</div>

<form action="{{ route('categories.update', $category->id) }}" method="post">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-md-6 offset-3">

			<div class="form-group">
				<label for="name">Category Name</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $category->name }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save Changes</button>
				<a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>

		</div>
		
	</div>
</form>
@endsection