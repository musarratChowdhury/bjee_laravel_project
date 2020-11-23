@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">All Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('editor.submissions') }}" class="list-group-item list-group-item-action">
							All Submissions
						</a>
						<a href="{{ route('editor.reviewers') }}" class="list-group-item list-group-item-action active">
							Reviewers
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<strong>All Users</strong>
					<a href="{{ route('editor.addNewReviewer') }}" class="float-right btn btn-sm btn-outline-dark">
						Add New Reviewer
					</a>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Joining Date</th>
								<th>#</th>
							</tr>
							@foreach ($reviewers as $user)
							@if ($user->hasrole('reviewer'))
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->created_at }}</td>								
								<td> # </td>

							</tr>
							@endif

							@endforeach
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
				<div class="card-footer">
					{{-- {{ $reviewers->links() }} --}}
				</div>
			</div>


		</div>

	</div>
</div>
@endsection