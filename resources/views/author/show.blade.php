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
								<td>ID</td>
								<td>{{ 'BJEE-' . \Carbon\Carbon::parse($submission->created_at)->format('Y') . '-' . str_pad($submission->id, '4', '0', STR_PAD_LEFT) }}</td>
							</tr>	
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
							<!--<tr>-->
							<!--	<td>Abstract</td>-->
							<!--	<td>{{ $submission->abstract }}</td>-->
							<!--</tr>-->
							<tr>
								<td>Submission Type</td>
								<td>{{ $submission->typeName->name ?? '' }}</td>
							</tr>
							<tr>
								<td>Is the manuscript a candidate for a special issue?</td>
								<td>
									{{ $submission->special_issue > 0 ? ('Yes : ' . $submission->specialIssue->name) : ($submission->special_issue === null ? '-' : 'No')  }}
								</td>
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
					<embed src="{{ action('ReviewerController@viewPdf', [$submission->id, $submission->file->id ]  ) }}"
						type="application/pdf" width="100%" height="750px" />
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
							<!--<tr>-->
							<!--	<td>{{ $submission->user->name }}</td>-->
							<!--	<td>{{ $submission->user->email }}</td>-->
							<!--</tr>-->
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
							@forelse($keywords as $index=>$keyword)
							<tr>
								<!--<td>{{ $keyword->keyword->id }}</td>-->
								<td>{{ ++ $index }}</td>
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

							{{-- <tr>
								<td>Funding</td>
								<td>
									@if ($submission->funding === 1)
									Yes
									@endif
									@if ($submission->funding === 0)
									No
									@endif
									@if ($submission->funding === null)
									-
									@endif
								</td>
							</tr>
							<tr>
								<td>Number of Figures</td>
								<td>{{ $submission->number_of_figures }}</td>
							</tr>
							<tr>
								<td>Number of Color Figures</td>
								<td>{{ $submission->number_of_color_figures }}</td>
							</tr> --}}

							{{-- <tr>
								<td>Number of Tables</td>
								<td>{{ $submission->number_of_tables }}</td>
							</tr> --}}

							<tr>
								<td>Number of Words</td>
								<td>{{ $submission->number_of_words }}</td>
							</tr>

							<tr>
								<td>Has this manuscript been submitted previously to this journal?</td>
								<td>
									@if ($submission->manuscript_previously === 1)
									Yes
									@endif
									@if ($submission->manuscript_previously === 0)
									No
									@endif
									@if ($submission->manuscript_previously === null)
									-
									@endif
								</td>
							</tr>

							{{-- <tr>
								<td>Are you willing to pay the journal's fee for color reproduction?</td>
								<td>
									@if ($submission->color_reproduction === 1)
									Yes
									@endif
									@if ($submission->color_reproduction === 0)
									No
									@endif
									@if ($submission->color_reproduction === null)
									-
									@endif
								</td>
							</tr> --}}

							{{-- <tr>
								<td>Do you have any conflict of interest?</td>
								<td>
									@if ($submission->conflict_of_interest === 1)
									Yes
									<br>
									Conflict of Interest are;
									<br>
									{{ $submission->conflict_of_interest_yes ?? '-' }}
									@endif
									@if ($submission->conflict_of_interest === 0)
									No
									@endif
									@if ($submission->conflict_of_interest === null)
									-
									@endif
								</td>
							</tr> --}}

							{{-- <tr>
								<td>Is there a data set associated with this submission?</td>
								<td>
									@if ($submission->data_set_associated === 1)
									Yes
									@endif
									@if ($submission->data_set_associated === 0)
									No
									@endif
									@if ($submission->data_set_associated === null)
									-
									@endif
								</td>
							</tr>

							<tr>
								<td>All studies involving primary data collection from human subjects require approval
									from an institutional review board (IRB) or equivalent. If there is no IRB
									equivalent, in your country or institution, you will need to explain how you
									protected your study participants. Please select the appropriate box for your study:
								</td>
								<td>
									@if ($submission->human_subjects === 'a')
									A. No data from human subjects were used
									@endif
									@if ($submission->human_subjects === 'b')
									B. Only secondary data were used (i.e., this study team did not collect the data
									but
									had
									access to de-identified data)
									@endif
									@if ($submission->human_subjects === 'c')
									C. Primary data were collected but there was no IRB or equivalent approval
									because
									that
									is not available in my country/institution.
									<br>How you protected your study participants? :
									{{ $submission->human_subjects_details_c ?? '-' }}
									@endif
									@if ($submission->human_subjects === 'd')
									D. Primary data were collected and there was IRB or equivalent approval.
									<br>Date : {{ $submission->human_subjects_details_d ?? '-' }}
									@endif
									@if ($submission->human_subjects === null)
									-
									@endif
								</td>
							</tr> --}}

							<tr>
								<td>Accepted
									<small>
										Bangladesh Journal of Extension Education (BJEE) strongly recommend that authors save and retain their own
										copies of any manuscript files uploaded for peer review. Should your manuscript
										be accepted for publication, you may need a copy of your Accepted Manuscript*
										files for future use, eg. posting to repositories in order to comply with
										research funder policies.
									</small>
								</td>
								<td>
									@if ($submission->confirm_recommendation === 1)
									Yes
									@endif
									@if ($submission->confirm_recommendation === 0)
									No
									@endif
								</td>
							</tr>

						</tbody>
					</table>
					<hr>


					<h2>Reviews</h2>

					@if (
					$submission->status->name === 'accepted' ||
					$submission->status->name === 'rejected' ||
					$submission->status->name === 'require modifications'
					)

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
										<td>{{ $review['rating'] ?? ' - ' }}</td>
										<td>{{ $review['comments'] ?? ' - ' }}</td>
										<td>
											@isset($review['file'])	

												@if ($review['file'] === null)
												No File Added by the Reviewer.
												@else
												<a class="btn btn-sm btn-outline-dark btn-block"
													href="{{ route('downloadReviewFile', $review['id']) }}">
													Download Reviewer's Given File
												</a>
												@endif

											@endisset

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

					@endif

					@if ($submission->status->name === 'draft' )
					<div class="card">
						<div class="card-body">
							<p class="card-text">
								Your Submission is currently in Draft.
							</p>
						</div>
					</div>
					@endif

					@if ($submission->status->name === 'review in progress' )
					<div class="card">
						<div class="card-body">
							<p class="card-text">
								Your Submission is currently in Review.
							</p>
						</div>
					</div>
					@endif


				</div>

				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection