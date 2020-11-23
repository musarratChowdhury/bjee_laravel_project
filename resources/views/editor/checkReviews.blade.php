@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Details <strong></strong> Submissions</div>
				<div class="card-body">

					<h2 id="Reviews">Reviews of {{ $submission->title }}</h2>

					<div class="card">
						<div class="card-body">
							<h6 class="card-subtitle mb-2 text-muted">Status: {{  $submission->status->name }}</h6>
							<p class="card-text">
								Number of Reviewers : {{ count($submission->reviewers) }} <br>
								Submitted for Review : {{ $num_of_cycle }} times <br>

								Review started at: {{  $submission->review_start_date }} <br>
								Review ended at: {{  $submission->review_end_date ?? 'Not Ended Yet.' }} <br>
							</p>

							@forelse ($review_cycles as $cycle)
							<div class="card">
								<div class="card-body">
									<h6 class="card-subtitle mb-2 text-muted">Review : {{  $submission->status->name }}
									</h6>
									Review Submit # {{  $num_of_cycle-- }}
									@isset($reviews[$cycle->id])
									<table class="table table-striped">
										<thead class="thead-dark">
											<tr>
												<th>Rating Id</th>
												<th>Comments</th>
												<th>File</th>
												<th>Review Time</th>
											</tr>

										</thead>
										<tbody>
											@forelse ($reviews[$cycle->id] as $review)
											<tr>
												<td>{{ $review['rating'] }}</td>
												<td>{{ $review['comments'] }}</td>
												<td>
													@if ($review['file'] === null)
													No File Added by the Reviewer.
													@else
													<a class="btn btn-sm btn-outline-dark btn-block"
														href="{{ route('downloadReviewFile', $review['id']) }}">
														Download Reviewer's Given File
													</a>
													@endif
												</td>
												<td>{{ $review['created_at'] }}</td>
											</tr>
											@empty
											<tr>
												<td colspan="4">
													You have not made any review yet.
												</td>
											</tr>
											@endforelse


										</tbody>
									</table>
									@else

									@endisset


								</div>
							</div>
							@empty
							@endforelse





						</div>
					</div>


				</div>

				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection