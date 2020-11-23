@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Details <strong>{{ $submission->title }}</strong> Submissions</div>
				<div class="card-body">

					<h2>Submission Abstruct</h2>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Criteria</th>
								<th scope="col">Details</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Title</td>
								<td>{{ $submission->title }}</td>
							</tr>
							<tr>
								<td>Running Head</td>
								<td>{{ $submission->running_head }}</td>
							</tr>
							<tr>
								<td>Abstract</td>
								<td>{{ $submission->abstract }}</td>
							</tr>
							<tr>
								<td>Abstract</td>
								<td>{{ $submission->abstract }}</td>
							</tr>
							<tr>
								<td>Submission Type</td>
								<td>{{ $submission->typeName->name ?? '' }}</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<h2>Files</h2>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Actions</th>
								<th scope="col">Download File</th>
								<th scope="col">Upload Date</th>
								<th scope="col">Uploaded By</th>
							</tr>
						</thead>
						<tbody>
							@isset($submission->file->pdf)

							<tr>
								<td> <a onclick="return confirm('Are you sure?');"
										href="{{ route('submission.step2DeleteFile',[ $submission->id, $submission->file->id] ) }}">
										Delete File</a> </td>
								<td>
									<a target="_blank"
										href="{{ route('submission.step2DownloadWord',[ $submission->id, $submission->file->id, $submission->file->word] ) }}">
										MSWord
									</a> |
									<a target="_blank"
										href="{{ route('submission.step2DownloadPDF',[ $submission->id, $submission->file->id, $submission->file->pdf]) }}">
										PDF
									</a>
								</td>
								<td>{{ $submission->file->updated_at }}</td>
								<td>{{ $submission->user->name }}</td>
							</tr>
							@else
							<tr>
								<td colspan="4" class="text-center">No files Added yet</td>
							</tr>
							@endisset

						</tbody>
					</table>
					<hr>
					<h2>Authors</h2>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">name</th>
								<th scope="col">Email</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $submission->user->name }}</td>
								<td>{{ $submission->user->email }}</td>
							</tr>
							@foreach ($authors as $author)
							<tr>
								<td>{{ $author->name ?? '-' }}</td>
								<td>{{ $author->email }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<hr>

					<h2>Keywords</h2>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($keywords as $keyword)
							<tr>
								<td>{{ $keyword->keyword->id }}</td>
								<td>{{ $keyword->keyword->name }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="2"> No Keyword added</td>
							</tr>
							@endforelse

						</tbody>
					</table>
					<hr>

					<h2>Submission Details</h2>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Criteria</th>
								<th scope="col">Details and Comments</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Cover Letter</td>
								<td>{{ $submission->cover_letter }}</td>
							</tr>
							<tr>
								<td>Number of Figures</td>
								<td>{{ $submission->number_of_figures }}</td>
							</tr>
							<tr>
								<td>Number of Color Figures</td>
								<td>{{ $submission->number_of_color_figures }}</td>
							</tr>
							<tr>
								<td>Number of Tables</td>
								<td>{{ $submission->number_of_tables }}</td>
							</tr>
							<tr>
								<td>Number of Words</td>
								<td>{{ $submission->number_of_words }}</td>
							</tr>
						</tbody>
					</table>
					<hr>

					<h2>Reviewers</h2>

					@forelse ($reviews as $review)
					<div class="card">
						<div class="card-body">
							<h5 class="card-title h4">Review id : {{ $review->id }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Status: {{ $review->verdict->name }}</h6>
							<p class="card-text">
								Number of Reviewers : {{ count($review->reviewers) }} <br>
								Review started at: {{ $review->created_at }} <br>
								Review ended at: {{ $review->end_date ?? 'Not Ended Yet.' }} <br>
							</p>
							@if (count($review->reviewers) > 0)
							<h5 class="card-text">
								Review Details
							</h5>
							<table class="table table-striped">
								<thead class="thead-dark">
									<tr>
										<th>Reviewer Id</th>
										<th>Name</th>
										<th>Review Status</th>
										<th>Review Details</th>
									</tr>

								</thead>
								<tbody>
									@forelse ($review->reviewers as $reviewer)
									<tr>
										<td> {{  $reviewer->id }} </td>
										<td> {{ $reviewer->user->name }} </td>
										<td>
											@if ($reviewer->accepted === null )
											Review has not reponded yet.
											@endif
											@if ($reviewer->accepted === 1 )
											Review has accepted.
											@endif
											@if ($reviewer->accepted === 0 )
											Review has rejected.
											@endif
										</td>
										<td>
											@if ($reviewer->accepted === 1 && $reviewer->rating !== null )
											Review Rating: {{ $reviewer->rating }} <br>
											Review comments: {{ $reviewer->comments }} <br>
											Review File: {{ $reviewer->file }} <br>
											@else
											-
											@endif
										</td>
									</tr>
									@empty

									@endforelse

								</tbody>
							</table>

							@endif



						</div>
					</div>
					@empty
					Not Submitted for reviews yet.
					@endforelse


				</div>

				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection