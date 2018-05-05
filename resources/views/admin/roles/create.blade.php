@extends('layouts.admin')

@section('title', 'Create A New Role')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Create New Roles</h2>
</div>

<form action="{{ route('roles.store') }}" method="post">
	@csrf
	<div class="row mb-2">
		<div class="col-md-12">
			<div class="card mb-2 box-shadow">
				<div class="card-body">
					<h3 class="mb-4 text-dark">Role Details</h3>
					
					<div class="form-group">
						<label for="name">Name (Human Readable)</label>
						<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
						@if($errors->has('name'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="slug">Slug (Can't be edited)</label>
						<input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug') }}">
						@if($errors->has('slug'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('slug') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="description">Role Description:</label>
						<input type="text" name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" value="{{ old('description') }}">
						@if($errors->has('description'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
						@endif
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-md-12">
			<div class="card mb-2 box-shadow">
				<div class="card-body">
					<h3 class="mb-4 text-dark">Permissions</h3>
					<div class="form-group">
						@foreach ($permissions as $permission)
							<div class="custom-control custom-checkbox my-1 mr-sm-2">
							    <input type="checkbox" class="custom-control-input" value="{{ $permission->id }}" name="permissions[]" id="{{ $permission->name }}">
							    <label class="custom-control-label" for="{{ $permission->name }}"> {{ $permission->name }} <em>({{ $permission->description }})</em></label>
							  </div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-outline-success">Save New Role</button>
		<a href="{{ route('roles.index') }}" class="btn btn-outline-danger">Cancel</a>
	</div>

</form>

@endsection