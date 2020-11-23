@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>All Users</strong>

					<a href="{{ route('admin.addNewUser') }}" class="float-right btn btn-sm btn-outline-dark">Add New
						User</a>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Status</th>
								<th>Email</th>
								<th>Joining Date</th>
								<th>Role(s)</th>
								<th>#</th>
							</tr>
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->status === 1 ? 'Active' : 'Deactivated' }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->created_at }}</td>
								<td>
									
									@forelse ($user->roles as $role)
									<span class="badge badge-pill badge-success">{{ $role->name }}</span>
									@empty
									<span class="badge badge-pill badge-danger">No Roles</span>
									@endforelse
								</td>
								<td>
									<a href="{{ route('admin.manageUser', $user->id) }}"
										class="btn btn-sm btn-outline-primary">Manage</a>

								</td>

							</tr>
							@endforeach
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
				<div class="card-footer">
					{{ $users->links() }}
				</div>
			</div>


		</div>

	</div>
</div>
@endsection