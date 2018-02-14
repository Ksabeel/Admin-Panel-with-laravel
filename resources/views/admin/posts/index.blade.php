@extends('layouts.admin')

@section('title', 'All Posts')

@section('styles')
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.css') }}">
@endsection

@section('content')

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
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
	                            <th>Title</th>
	                            <th>Slug</th>
	                            <th>Body</th>
	                            <th>Image</th>
	                            <th>Created At</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr class="odd gradeX">
	                            <td>Trident</td>
	                            <td>Internet Explorer 4.0</td>
	                            <td>Win 95+</td>
	                            <td class="center">4</td>
	                            <td class="center">X</td>
	                            <td class="center">
	                            	<a href="#" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
	                            	<a href="#" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
	                            	<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
	                            </td>
	                        </tr>
	                    </tbody>
	                </table>
	            </div>
	            <!-- /.panel-body -->
	        </div>
	        <!-- /.panel -->
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
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