@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('reviewer.submissions') }}"
							class="list-group-item list-group-item-action active">
							Submissions To Review
						</a>
					</div>

				</div>
			</div>


		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Submissions To Review</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>Submition Title</th>
								<th>Author</th>
								<th>Submition Created Date</th>
								<th>Review Last Date</th>
								<th>Review Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($submissionToReview as $item)
							@continue($item->submission == null)
							<tr>
							    
								<td>
									{{ 'BJEE-' . \Carbon\Carbon::parse($item->submissioncreated_at)->format('Y') . '-' . str_pad($item->submission->id, '4', '0', STR_PAD_LEFT) }}
								    </td>
								<td>{{ $item->submission->user->name }}</td>
								<td>{{ $item->submission->created_at }}</td>
								<td>{{ $item->review_last_date }}</td>
								<td>
									@if ($item->accepted === null)
									You have not accepted review request yet.
									@endif
									@if ($item->accepted === 0)
									You have not rejected review request.
									@endif
									@if ($item->accepted === 1)
									You have accepted review request.
									@endif
								</td>
								<td>

									@if ($item->accepted === 1)
									<!--<a class="btn btn-outline-success btn-sm btn-block"										-->
									<!--	href="{{ route('reviewer.showSubmission', $item->submission->id) }}">-->
									<!--	View Submission Details-->
									<!--</a>-->
									<a class="btn btn-outline-success btn-sm btn-block"
										href="{{ route('reviewer.reviewDetails', [$item->submission->id]) }}">
										View your Review(s)
									</a>
									<a class="btn btn-outline-primary btn-sm btn-block"
										href="{{ route('reviewer.review', $item->submission->id) }}">
										Review Now
									</a>
									
									<!--@if (App\Helpers\Helper::openForReview($item->submission->id))-->
									
									<!--@endif-->

									@endif


								</td>
							</tr>
							@empty
							<tr>
								<td colspan="6">You have not assigned to any reviews</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="card-footer">
					{{ $submissionToReview->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection