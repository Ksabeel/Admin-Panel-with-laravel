@extends('layouts.admin')

@section('title', "Edit Category $category->name")

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit Category >>> {{ $category->name }}</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ route('categories.update', $category->id) }}" method="post">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label for="name">Category Name:</label>
					<input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
					@if($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Save Changes</button>
					<a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>
	</div>

@endsection