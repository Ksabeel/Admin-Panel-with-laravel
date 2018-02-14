@extends('layouts.admin')

@section('title', 'All Categories')

@section('styles')
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.css') }}">
@endsection

@section('content')

	<div class="row">
		<div class="col-lg-12">
			@include('layouts._messages')
			<h1 class="page-header">All Categories <a href="{{ route('categories.create') }}" class="btn btn-success pull-right">Add New Category</a></h1>
		</div>
	</div>

	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                Manage All Categories 
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	                    <thead>
	                        <tr>
	                            <th width="30">ID</th>
	                            <th class="text-center">Category Name</th>
	                            <th class="text-center">Created At</th>
	                            <th class="text-center">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($categories as $category)
	                        	<tr class="odd gradeX">
	                        	    <td class="text-center">{{ $loop->iteration }}</td>
	                        	    <td class="text-center">{{ $category->name }}</td>
	                        	    <td class="text-center">{{ $category->created_at->diffForHumans() }}</td>
	                        	    <td class="text-center">
	                        	    	<a href="#" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
	                        	    	<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>

	                        	    	<form action="{{ route('categories.destroy', $category->id) }}" id="delete-category-{{ $category->id }}" style="display: none;" method="post">
	                        	    		{{ csrf_field() }}
	                        	    		{{ method_field('DELETE') }}
	                        	    	</form>

	                        	    	<button type="submit" class="btn btn-xs btn-danger" onclick="
	                        	    	if( confirm('Are you sure, you want to delete this.?')) {
	                        	    	event.preventDefault();
	                        	    	document.getElementById('delete-category-{{ $category->id }}').submit();
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