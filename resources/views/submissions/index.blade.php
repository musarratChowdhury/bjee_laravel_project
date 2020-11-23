@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">All Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('submissions') }}" class="list-group-item list-group-item-action active">
							All Submissions
						</a>
						<a href="{{ route('editor.reviewers') }}" class="list-group-item list-group-item-action">
							Reviewers
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Submissions</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>Id</th>
								<th>Submitted by</th>
								<th>Title</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($submissions as $submission)
							<tr>
								<td>
									{{ $submission->id }}
									<br>

								</td>
								<td> <a href="#">{{ $submission->user->name }}</a> </td>

								<td>
									{{ $submission->title ?? '(No Title Entered)' }}
								</td>


								<td> {{ $submission->created_at }} </td>

								<td>

									<span class="badge badge-dark">{{ $submission->status->name }}</span>

									{{-- @if ($submission->reviewing == 1)
									Submitted for Review
									@endif

									@if ($submission->reviewing == 0)
									<a href="{{ route('submission.step1', $submission->id) }}">Not Submitted for
									Review</a>
									@endif --}}

								</td>


								<td>

									@if (
									$submission->status->name === 'draft' ||
									$submission->status->name === 'review in progress'
									)

									@role('author')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('submissions.show',  $submission->id) }}">
										View Submission Details
									</a>
									@endrole

									@role('editor|superadmin')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									@endrole

									@endif

									@if ($submission->status->name === 'review in progress')
										<a class="btn btn-outline-dark btn-sm btn-block"
											href="{{ route('submissions.assignReviewer',  $submission->id) }}">
											Assign Reviewers
										</a>
										<a class="btn btn-outline-dark btn-sm btn-block"
											href="{{ route('editor.checkSubmissionReviews',  $submission->id) }}">
											Check Reviews
										</a>
										<a class="btn btn-outline-dark btn-sm btn-block"
											href="{{ route('editor.endReview',  $submission->id) }}">
											End Review Process
										</a>
									@endif

									@if ($submission->status->name === 'rejected')
									<a class="btn btn-outline-danger btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									<a class="btn btn-sm btn-outline-danger btn-block"
										onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"
										href="{{ route('deleteSubmission', $submission->id) }}">Delete
									</a>
									@endif

									@if ($submission->status->name === 'accepted')
									<a class="btn btn-outline-success btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									@endif

									@if ($submission->status->name === 'require modifications')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Details
									</a>
									@endif


									{{-- <a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('submissions.show',  $submission->id) }}">Details</a>
									@if ($submission->reviewing == 1)
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('submissions.assignReviewer',  $submission->id) }}">Assign
										Reviewers</a>
									@endif

									{{-- <a onclick="return confirm('Are you sure?');"
										href="{{ route('deleteSubmission', $submission->id) }}">Delete</a> --}}
								</td>
								@empty
							<tr>
								<td colspan="6" class="text-center">No files Added yet</td>
							</tr>
							@endforelse

						</tbody>
					</table>
				</div>

				<div class="card-footer">
					{{ $submissions->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection