@extends('layouts.admin')

@section('title', 'All Admins')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@endsection

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h2 class="h2">All Admins</h2>
	<a href="{{ route('admins.create') }}" class="btn btn-outline-success">Add New Admin</a>
</div>

@include('layouts._messages')
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="card bg-light">
			<div class="card-header">
				Manage All Admins
			</div>
			<div class="card-body">
				<table class="table table-striped table-bordered table-hover" id="dataTable">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Admin Name</th>
							<th>Admin E-Mail</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($admins as $admin)
						<tr class="text-center">
							<td>{{ $loop->iteration }}</td>
							<td>{{ $admin->name }}</td>
							<td>{{ $admin->email }}</td>
							<td>{{ $admin->created_at->diffForHumans() }}</td>
							<td>
								<a href="#" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
								<a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
								<form action="{{ route('admins.destroy', $admin->id) }}" id="delete-admin-{{ $admin->id }}" style="display: none;" method="post">
									@csrf
									@method('DELETE')
								</form>
								<button type="submit" class="btn btn-sm btn-outline-danger" onclick="
								if( confirm('Are you sure, you want to delete this.?')) {
								event.preventDefault();
								document.getElementById('delete-admin-{{ $admin->id }}').submit();
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