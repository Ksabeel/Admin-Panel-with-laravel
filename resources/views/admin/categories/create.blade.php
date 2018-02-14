@extends('layouts.admin')

@section('title', 'Create A New Category')

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Create New Category</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ route('categories.store') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label for="name">Category Name:</label>
					<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
					@if($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Save New Category</button>
					<a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>
	</div>

@endsection