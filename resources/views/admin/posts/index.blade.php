@extends('layouts.admin')

@section('title', 'All Posts')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@endsection

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">All Posts</h2>
	<a href="{{ route('posts.create') }}" class="btn btn-outline-success">Add New Post</a>
</div>

@include('layouts._messages')
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="card bg-light">
			<div class="card-header">
				Manage All Posts
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-striped table-bordered table-hover" id="dataTable">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Title</th>
							<th>Slug</th>
							<th>Body</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
						<tr class="text-center">
							<td>{{ $loop->iteration }}</td>
							<td>{{ $post->title }}</td>
							<td>{{ $post->slug }}</td>
							<td>{{ substr(strip_tags($post->body), 0, 20) }}  {{ strlen(strip_tags($post->body)) > 25 ? '....' : '' }}</td>
							<td>{{ $post->created_at->diffForHumans() }}</td>
							<td>
								<a href="#" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
								<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
								
								<form action="{{ route('posts.destroy', $post->id) }}" id="delete-post-{{ $post->id }}" style="display: none;" method="post">
									@csrf
									@method('DELETE')
								</form>
								<button type="submit" class="btn btn-sm btn-outline-danger" onclick="
								if( confirm('Are you sure, you want to delete this.?')) {
								event.preventDefault();
								document.getElementById('delete-post-{{ $post->id }}').submit();
								} else { event.preventDefault(); }">
								<i class="fa fa-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>

@endsection

@section('scripts')

	<script src="{{ asset('js/datatables.js') }}"></script>
	<script>
		$(document).ready(function() {
		$('#dataTable').DataTable();
		} );
	</script>

@endsection