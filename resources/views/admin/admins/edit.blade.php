@extends('layouts.admin')

@section('title', "Edit User $admin->name")

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Edit Admin <i class="fa fa-arrow-right"></i> {{ $admin->name }}</h2>
</div>

<form action="{{ route('admins.update', $admin->id) }}" method="post">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-md-6">
			
			<div class="form-group">
				<label for="name">Admin Name</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $admin->name }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<label for="email">Admin Email</label>
				<input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" disabled>
			</div>

			<div class="form-group">
				<div class="custom-control custom-radio my-1 mr-sm-2">
				    <input type="radio" class="custom-control-input" name="password_options" value="keep" id="keep" v-model="password_options">
				    <label class="custom-control-label" for="keep"> Do Not Change Password</label>
				</div>

				<div class="custom-control custom-radio my-1 mr-sm-2">
				    <input type="radio" class="custom-control-input" name="password_options" value="auto" id="auto" v-model="password_options">
				    <label class="custom-control-label" for="auto"> Auto Generate Password</label>
				</div>

				<div class="custom-control custom-radio my-1 mr-sm-2">
				    <input type="radio" class="custom-control-input" name="password_options" value="manual" id="manual" v-model="password_options">
				    <label class="custom-control-label" for="manual"> Manually Generate Password</label>
				</div>

				<input type="password" name="password" v-if="password_options === 'manual'" id="password" class="form-control" placeholder="Type Your Password">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save Changes</button>
				<a href="{{ route('admins.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>
		</div>

		<div class="col-md-4 offset-1">
			<h4 class="h4">Assign Roles</h4>

			<div class="form-group">
				@foreach ($roles as $role)
					<div class="custom-control custom-checkbox my-1 mr-sm-2">
					    <input type="checkbox" class="custom-control-input" value="{{ $role->id }}"
							@foreach ($admin->roles as $admin_role)
								@if ($admin_role->id == $role->id)
									checked
								@endif								
							@endforeach
					     name="roles[]" id="{{ $role->id }}">
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
				password_options: 'keep'
			}
		});

	</script>

@endsection