@extends('layouts.admin')

@section('title', "Edit User $user->name")

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Edit User <i class="fa fa-arrow-right"></i> {{ $user->name }}</h2>
</div>

<form action="{{ route('register') }}" method="post">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-md-6">
			
			<div class="form-group">
				<label for="name">User Name</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $user->name }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<label for="email">User Email</label>
				<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
			</div>

			<div class="form-group">
				<label for="password">User Password</label>
				<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
				@if($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group">
				<label for="password-confirm">Confirm Password</label>
				<input type="password" name="password_confirmation" id="password-confirm" class="form-control">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save Changes</button>
				<a href="{{ route('users.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>

		</div>
	</div>
</form>

@endsection