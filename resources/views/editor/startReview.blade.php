@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Details <strong>{{ $submission->title }}</strong> Submissions</div>
				<div class="card-body">
					<form enctype="multipart/form-data" action="{{ route('editor.startReviewPost', $submission->id) }}"
						method="post">
						@csrf
						<div class="form-group">
							<label for="verdict">
								Review Process Options
							</label>
							<select required class="form-control" id="verdict" name="verdict">
								<option value="">Select ... </option>
								<option value="start">Start the Review</option>
								@foreach ($verdicts as $verdict)
								@continue(
								$verdict->id == 0 ||
								$verdict->id == 1 ||
								$verdict->id == 4 ||
								$verdict->id == 5 
								)
								<option value="{{ $verdict->id }}">{{ $verdict->name }}</option>
								@endforeach

							</select>
						</div>
						{{-- <div class="form-group">
							<label for="comments">Editor Comments</label>
							<textarea required class="form-control" id="comments" name="comments" rows="3"
								placeholder="Give your comments about Submission"></textarea>
						</div> --}}
						<div class="form-group">
							{{-- <input type="hidden" class="custom-control-input" id="status" name="status">
							<button id="draft" type="submit" class="saveform btn btn-outline-primary btn-block">Save as
								Draft</button> --}}
							<button id="saved" type="submit" class="saveform btn btn-primary btn-block">Submit Your
								Review</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Details <strong>{{ $submission->title }}</strong> Submissions</div>
				<div class="card-body">

					<h2 id="Reviews">Reviews</h2>

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
												<td>{{ $review['file'] }}</td>
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

				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection