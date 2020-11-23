@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Review Detail for <strong>{{ $submission->title }}</strong>
					Submissions</div>
				<div class="card-body">
					<h5 class="card-title">Submission Tittle{{ $submission->title }}</h5>
					<h6 class="card-subtitle mb-2 text-muted">Review id: {{ $reviewer->user->id }}</h6>
					<p class="card-text">
						Accecpted to Review on : {{ $reviewer->accepted_time }} <br>
					</p>

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
							@forelse ($reviews as $review)
							<tr>
								<td>{{ $review->rating }}</td>
								<td>{{ $review->comments }}</td>
								<td>
									@if ($review->file === null)
									No File Added by the Reviewer.
									@else
									<a class="btn btn-sm btn-outline-dark btn-block"
										href="{{ route('downloadReviewFile', $review->id) }}">
										Download File
									</a>
									@endif
								</td>
								<td>{{ $review->created_at }}</td>
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



				</div>

				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection