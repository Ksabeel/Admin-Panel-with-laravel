@extends('layouts.admin')

@section('title', 'Create A New Post')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Create New Post</h1>
		</div>
	</div>

	<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label for="title">Title:</label>
					<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
					@if($errors->has('title'))
						<span class="help-block">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
					<label for="slug">Slug:</label>
					<input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
					@if($errors->has('slug'))
						<span class="help-block">
							<strong>{{ $errors->first('slug') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
					<label for="category_id">Categories:</label>
					<select name="category_id" id="category_id" class="form-control" value="{{ old('category_id') }}">
						<option>Select Category</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
					@if($errors->has('category_id'))
						<span class="help-block">
							<strong>{{ $errors->first('category_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
					<label for="tags">Tags:</label>
					<select name="tags[]" id="tags" class="form-control select2" multiple="multiple" data-palceholder="Select Tags" value="{{ old('tags') }}">
						@foreach($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>
					@if($errors->has('tags'))
						<span class="help-block">
							<strong>{{ $errors->first('tags') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
					<label for="image">Image:</label>
					<input type="file" class="form-control" name="image" id="image">
					@if($errors->has('image'))
						<span class="help-block">
							<strong>{{ $errors->first('image') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-inline {{ $errors->has('posted_by') ? 'has-error' : '' }}" style="margin-top: 40px;">
					<input type="checkbox" name="posted_by" id="posted_by" value="1">
					<label for="posted_by">Posted By:</label>
					@if($errors->has('posted_by'))
						<span class="help-block">
							<strong>{{ $errors->first('posted_by') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				<label for="body">Body:</label>
				<textarea name="body" id="editor1" rows="20" class="form-control">{{ old('body') }}</textarea>
				@if($errors->has('body'))
					<span class="help-block">
						<strong>{{ $errors->first('body') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success">Save New Post</button>
				<a href="{{ route('posts.index') }}" class="btn btn-danger">Cancel</a>
			</div>
		</div>
	</form>

@endsection

@section('scripts')
 <script src="{{ asset('js/select2.full.min.js') }}"></script>
 <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
 <script>
 	$('.select2').select2()
 	$( function() {
 		CKEDITOR.replace('editor1')
 	})
 </script>
@endsection