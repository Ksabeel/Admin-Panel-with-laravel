@extends('layouts.admin')

@section('title', 'Create A New Permission')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Create New Permissions</h2>
</div>

<form action="{{ route('permissions.store') }}" method="post">
	<div class="row">
		<div class="col-md-12">
			@csrf
			<div class="form-group">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="basic" name="permission_type" class="custom-control-input" value="basic" v-model="permissionType">
					<label class="custom-control-label" for="basic">Basic Permission</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="crud" name="permission_type" class="custom-control-input" value="crud" v-model="permissionType">
					<label class="custom-control-label" for="crud">CRUD Permission</label>
				</div>
			</div>
			
			{{-- Basic Permission --}}
			<div class="form-group" v-if="permissionType == 'basic'">
				<label for="name">Name (Display Name)</label>
				<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group" v-if="permissionType == 'basic'">
				<label for="slug">Slug:</label>
				<input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug') }}">
				@if($errors->has('slug'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('slug') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group" v-if="permissionType == 'basic'">
				<label for="description">Description:</label>
				<input type="text" name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" value="{{ old('description') }}" placeholder="What's the permission does">
				@if($errors->has('description'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
				@endif
			</div>
			
		</div>
	</div>
	{{-- Basic Permission End --}}
	{{-- CRUD Permission --}}
	<div class="form-group" v-if="permissionType == 'crud'">
		<label for="resource">Resource</label>
		<input type="text" name="resource" id="resource" class="form-control {{ $errors->has('resource') ? 'is-invalid' : '' }}" value="{{ old('resource') }}" placeholder="The name of the resource" v-model="resource">
		@if($errors->has('resource'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('resource') }}</strong>
		</span>
		@endif
	</div>
	
	<div class="row" v-if="permissionType == 'crud'">
		<div class="col-md-6">
			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" value="create" v-model="crudSelected" id="create">
					<label class="custom-control-label" for="create">Create</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" value="read" v-model="crudSelected" id="read">
					<label class="custom-control-label" for="read">Read</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" value="update" v-model="crudSelected" id="update">
					<label class="custom-control-label" for="update">Update</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" value="delete" v-model="crudSelected" id="delete">
					<label class="custom-control-label" for="delete">Delete</label>
				</div>
			</div>
		</div>
		<input type="hidden" name="crud_selected" :value="crudSelected">
		<div class="col-md-6">
			<table class="table bg-white">
				<thead>
					<th>Name</th>
					<th>Slug</th>
					<th>Description</th>
				</thead>
				<tbody v-if="resource.length >= 3">
					<tr v-for="item in crudSelected">
						<td v-text="crudName(item)"></td>
						<td v-text="crudSlug(item)"></td>
						<td v-text="crudDescription(item)"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-outline-success">Save New Permission</button>
		<a href="{{ route('permissions.index') }}" class="btn btn-outline-danger">Cancel</a>
	</div>
</form>
@endsection

	@section('scripts')
	<script>
		var app = new Vue({
			el: '#app',
			data: {
				permissionType: 'basic',
				resource: '',
				crudSelected: ['create', 'read', 'update', 'delete']
			},
			methods: {
				crudName(item) {
					return item.substr(0,1).toUpperCase() + item.substr(1) +" "+ app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
				},
				crudSlug(item) {
					return item.toLowerCase() + "-" + app.resource.toLowerCase();
				},
				crudDescription(item) {
					return "Allow a User " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
				}
			}
		});
	</script>
@endsection