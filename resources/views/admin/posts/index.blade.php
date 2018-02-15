@extends('layouts.admin')

@section('title', 'All Posts')

@section('styles')
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.css') }}">
@endsection

@section('content')

	<div class="row">
		<div class="col-lg-12">
			@include('layouts._messages')
			<h1 class="page-header">All Posts <a href="{{ route('posts.create') }}" class="btn btn-success pull-right">Add New Post</a></h1>
		</div>
	</div>

	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                Manage All Posts 
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	                    <thead>
	                        <tr>
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
	                        	<tr class="odd gradeX">
	                        	    <td>{{ $loop->iteration }}</td>
	                        	    <td>{{ $post->title }}</td>
	                        	    <td>{{ $post->slug }}</td>
	                        	    <td class="center">{{ substr(strip_tags($post->body), 0, 20) }}  {{ strlen(strip_tags($post->body)) > 25 ? '....' : '' }}</td>
	                        	    <td class="center">{{ $post->created_at->diffForHumans() }}</td>
	                        	    <td class="center">
	                        	    	<a href="#" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
	                        	    	<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
	                        	    	
	                        	    	<form action="{{ route('posts.destroy', $post->id) }}" id="delete-post-{{ $post->id }}" style="display: none;" method="post">
	                        	    		{{ csrf_field() }}
	                        	    		{{ method_field('DELETE') }}
	                        	    	</form>

	                        	    	<button type="submit" class="btn btn-xs btn-danger" onclick="
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
	            <!-- /.panel-body -->
	        </div>
	        <!-- /.panel -->
	    </div>
	    <!-- /.col-lg-12 -->
	</div>

@endsection

@section('scripts')
	<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
	<script>
	$(document).ready(function() {
	    $('#dataTables-example').DataTable({
	        responsive: true
	    });
	});
	</script>
@endsection