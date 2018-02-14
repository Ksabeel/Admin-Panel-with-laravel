@extends('layouts.admin')

@section('title', 'Create A New Post')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Create New Post</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="title">Title:</label>
				<input type="text" name="title" id="title" class="form-control">
			</div>
			<div class="form-group">
				<label for="slug">Slug:</label>
				<input type="text" name="slug" id="slug" class="form-control">
			</div>
			<div class="form-group">
				<label for="category">Categories:</label>
				<select name="category_id" id="category_id" class="form-control">
					<option>Select Category</option>
					<option value="1">Sabeel</option>
					<option value="1">Kainat</option>
					<option value="1">Aqeel</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="tags">Tags:</label>
				<select name="tags" id="tags" class="form-control select2" multiple="multiple" data-palceholder="Select Tags">
					<option>Sabeel</option>
					<option>Kainat</option>
					<option>Aqeel</option>
					<option>Ans</option>
					<option>Hina</option>
				</select>
			</div>
			<div class="form-group">
				<label for="image">Image:</label>
				<input type="file" class="form-control" name="image" id="image">
			</div>
			<div class="form-inline" style="margin-top: 40px;">
				<input type="checkbox" name="posted_by" id="posted_by" class="mt-3">
				<label for="posted_by">Posted By:</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<label for="body">Body:</label>
			<textarea name="body" id="editor1" rows="20" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Save New Post</button>
		</div>
	</div>
</div>

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