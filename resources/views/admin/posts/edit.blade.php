@extends('layouts.admin')

@section('title', "Edit Post $post->slug")

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">Edit Post <i class="fa fa-arrow-right"></i> {{ $post->slug }}</h2>
</div>

	<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $post->title }}">
					@if($errors->has('title'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group">
					<label for="slug">Slug:</label>
					<input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug }}" disabled>
				</div>

				<div class="form-group">
					<label for="category_id">Categories:</label>
					<select name="category_id" id="category_id" class="custom-select  {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
						<option>Select Category</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
						@endforeach
					</select>
					@if($errors->has('category_id'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('category_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="tags">Tags:</label>
					<select name="tags[]" id="tags" class="custom-select select2  {{ $errors->has('tags') ? 'is-invalid' : '' }}" multiple="multiple" data-palceholder="Select Tags">
						@foreach($tags as $tag)
							<option value="{{ $tag->id }}"
								@foreach ($post->tags as $postTag)
									@if ($postTag->id == $tag->id)
										{{ 'selected' }}
									@endif
								@endforeach
								>{{ $tag->name }}</option>
						@endforeach
					</select>
					@if($errors->has('tags'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('tags') }}</strong>
						</span>
					@endif
				</div>

				<div class="form-group mt-5">
					<div class="custom-file">
						<input type="file" class="custom-file-input  {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image" id="image">
						<label for="image" class="custom-file-label">Choose File...</label>
						@if($errors->has('image'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group mt-5">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="posted_by" id="posted_by" value="1" {{ $post->posted_by == 1 ? 'checked' : 0 }}>
						<label for="posted_by" class="custom-control-label">Posted By:</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label for="body">Body:</label>
				<textarea name="body" id="editor1" rows="20" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ $post->body }}</textarea>
				@if($errors->has('body'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('body') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-outline-success">Save Changes</button>
				<a href="{{ route('posts.index') }}" class="btn btn-outline-danger">Cancel</a>
			</div>
		</div>
	</form>

@endsection

@section('scripts')

	<script src="{{ asset('js/select2.full.min.js') }}"></script>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		$('.select2').select2()
		$( function() {
			CKEDITOR.replace('editor1')
		})
	</script>
 
@endsection