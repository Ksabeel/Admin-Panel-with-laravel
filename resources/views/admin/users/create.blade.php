@extends('layouts.admin')

@section('title', 'Create A New Admin')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Create New Users</h2>
</div>

<form action="{{ route('users.store') }}" method="post">
	@csrf
	<div class="row">
		<div class="col-md-6">
			
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" required>
				@if($errors->has('email'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required v-if="!auto_password">
				@if($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
		      <div class="custom-control custom-checkbox">
		        <input type="checkbox" class="custom-control-input" id="auto_generate" name="auto_generate" v-model="auto_password">
		        <label class="custom-control-label" for="auto_generate"> Auto Generate Password</label>
		      </div>
		    </div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save New User</button>
				<a href="{{ route('users.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>
		</div>

		<div class="col-md-4 offset-1">
			<h4 class="h4">Assign Roles</h4>

			<div class="form-group">
				@foreach ($roles as $role)
					<div class="custom-control custom-checkbox my-1 mr-sm-2">
					    <input type="checkbox" class="custom-control-input" value="{{ $role->id }}" name="roles[]" id="{{ $role->id }}">
					    <label class="custom-control-label" for="{{ $role->id }}"> {{ $role->name }}</label>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</form>
@endsection

@section('scripts')

	<script>
		
		const app = new Vue({
			el: '#app',
			data: {
				auto_password: false
			}
		});

	</script>

@endsection