@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Author Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('author') }}"
							class="list-group-item list-group-item-action active">Manuscripts in Draft</a>
						<a href="{{ route('startSubmission') }}" class="list-group-item list-group-item-action">New Submission</a>
					</div>
				</div>
			</div>


		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Author Submissions</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th width='100'>ID</th>
								<th width='100'>Title</th>
								<th width='100'>Created at</th>
								<th width='100'>Status</th>
								<th width='200'>Actions</th>

							</tr>
						</thead>
						<tbody>
							@forelse ($submissions as $submission)
							<tr>
								<td> 
								{{ 'BJEE-' . \Carbon\Carbon::parse($submission->created_at)->format('Y') . '-' . str_pad($submission->id, '4', '0', STR_PAD_LEFT) }}
								</td>
								<td> {{ $submission->title ?? '(No Title Set)' }}<br>
								<td> {{ $submission->created_at }} </td>

								<td>

									<span class="badge badge-dark">{{ $submission->status->name }}</span>

									{{-- @if ($submission->reviewing == 1)
									Reviewing
									@endif

									@if ($submission->reviewing == 0)
									<a href="{{ route('submission.step1', $submission->id) }}">Continue</a>
									@endif
									<br>
									Draft
									<br>
									Submitted (Pending Review)
									<br>
									Accepted
									<br>
									Rejected --}}

								</td>
								</td>
								<td>

									@if ($submission->status->name === 'draft')
										<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ route('submission.step1', $submission->id) }}">
											Continue
										</a>

										<a class="btn btn-sm btn-outline-danger btn-block"
											onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"
											href="{{ route('deleteSubmission', $submission->id) }}">Delete
										</a>
									@endif

									@if ($submission->status->name === 'review in progress')
										<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ route('submission.show', $submission->id) }}">
											View Details
										</a>
									@endif

									@if ($submission->status->name === 'rejected')
										<a class="btn btn-sm btn-outline-success btn-block"
											href="{{ route('submission.show', $submission->id) }}">
											View Details
										</a>

										<a class="btn btn-sm btn-outline-danger btn-block"
											onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"
											href="{{ route('deleteSubmission', $submission->id) }}">Delete
										</a>
									@endif

									@if ($submission->status->name === 'accepted')
										<a class="btn btn-sm btn-outline-success btn-block"
											href="{{ route('submission.show', $submission->id) }}">
											View Details
										</a>
									@endif

									@if ($submission->status->name === 'submitted for review')
										<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ route('submission.show', $submission->id) }}">
											View Details
										</a>										
									@endif

									@if ($submission->status->name === 'require modifications')
									<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ route('submission.show', $submission->id) }}">
											View Details
										</a>
										<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ url('author/submission/'.$submission->id.'/view-mod-message') }}">
											Message
										</a>
										<a class="btn btn-sm btn-outline-dark btn-block"
											href="{{ route('submission.step1', $submission->id) }}">
											Continue
										</a>
										<!--<a class="btn btn-sm btn-outline-danger btn-block"-->
										<!--	onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"-->
										<!--	href="{{ route('deleteSubmission', $submission->id) }}">Delete-->
										<!--</a>-->
									@endif

								</td>
								@empty
							<tr>
								<td colspan="6" class="text-center">You have not made any Submission yet!</td>
							</tr>
							@endforelse

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection