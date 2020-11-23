@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('submission.step1', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 1: Manuscript Data</a>
						<a href="{{ route('submission.step3', $submission->id) }}"
						    class="list-group-item list-group-item-action">Step 2: Keywords</a>
						<a href="{{ route('submission.step2', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 3: File Upload</a>
						<a href="{{ route('submission.step4', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 4: Authors & Institutions</a>
						<a href="{{ route('submission.step5', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 5: Additional Information</a>
						<a href="{{ route('submission.step6', $submission->id) }}"
							class="list-group-item list-group-item-action active">Step 6: Review & Submit</a>
					</div>

				</div>
			</div>

		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Step 6: Review & Submit</div>
				<div class="card-body">

					<p class="card-text">
						Review the information below for correctness and make changes as needed. After reviewing the
						manuscript proofs at the foot of this page, you MUST CLICK 'SUBMIT' to complete your
						submission.
					</p>

					@if (count($msg) > 0)
					<hr>
					<div role="alert" class="alert alert-danger fade show">
						<strong>Submission information are missing.</strong>
						<ul>
							@foreach ($msg as $key1 => $value1)
							@if (is_array($value1) && count($value1) > 0)
							<li>{{ $key1 }}
								@foreach ($value1 as $value2)
								<ul>
									<li>{{ $value2 }}</li>
								</ul>
								@endforeach
							</li>
							@endif
							@endforeach
						</ul>
					</div>
					@endif


					<hr>
					<h3>Step 1: Type, Title, & Abstract</h3>
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
								<td>{{ $submission->title ?? '-' }}</td>
							</tr>
							<tr>
								<td>Running Head</td>
								<td>{{ $submission->running_head ?? '-' }}</td>
							</tr>
							<tr>
								<td>Abstract</td>
								<td>{{ $submission->abstract ?? '-' }}</td>
							</tr>
							<tr>
								<td>Is the manuscript a candidate for a special issue?</td>
								<td>
									{{ $special_issue }}
								</td>
							</tr>
							<tr>
								<td>Submission Type</td>
								<td>{{ $submission->typeName->name ?? 'Type is not Set ' }}</td>
							</tr>
						</tbody>
					</table>
					<hr>


					<h3>Step 2: File Upload</h3>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								{{-- <th scope="col">Actions</th> --}}
								<th scope="col">Download File</th>
								<th scope="col">View Submission</th>
							</tr>
						</thead>
						<tbody>
							@isset($submission->file->pdf)
							<tr>
								{{-- <td>
									<a onclick="return confirm('Are you sure?');"
										href="{{ route('submission.step2DeleteFile',[ $submission->id, $submission->file->id] ) }}">
								Delete File</a>
								</td> --}}
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
								<td>
									@if (isset($submission->file->pdf) && $submission->file->pdf != null)
									<a class="btn btn-sm btn-outline-dark btn-block"
										href="{{ route('outputSubmissions', $submission->id) }}" target="_blank">
										View Submission Files</a>
									@endif
								</td>
							</tr>
							@else
							<tr>
								<td colspan="2" class="text-center">No files Added yet</td>
							</tr>
							@endisset

						</tbody>
					</table>
					<hr>

					<h3>Step 3: Keywords</h3>
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

					<h3>Step 4: Authors & Institutions</h3>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">name</th>
								<th scope="col">Email</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<!--<td>{{ $submission->user->name }}</td>-->
								<!--<td>{{ $submission->user->email }}</td>-->
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

					<h3>Step 5: Details & Comments</h3>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col" width="220">Criteria</th>
								<th scope="col">Details and Comments</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Cover Letter</td>
								<td>{{ $submission->cover_letter ?? '-' }}</td>
							</tr>
							<tr>
								<td>Number of Figures</td>
								<td>{{ $submission->number_of_figures ?? '-' }}</td>
							</tr>
							<tr>
								<td>Number of Color Figures</td>
								<td>{{ $submission->number_of_color_figures  ?? '-'}}</td>
							</tr>
							<tr>
								<td>Number of Tables</td>
								<td>{{ $submission->number_of_tables ?? '-' }}</td>
							</tr>
							<tr>
								<td>Number of Words</td>
								<td>{{ $submission->number_of_words ?? '-' }}</td>
							</tr>
							<tr>
								<td>Funding</td>
								<td>{{ $submission->finding == null ? '-' : $submission->finding == 1 ? 'Yes' : 'No' }}
								</td>
							</tr>
							<tr>
								<td>Has this manuscript been submitted previously to this journal?</td>
								<td>{{ $submission->manuscript_previously == null ? '-' : $submission->manuscript_previously == 1 ? 'Yes' : 'No' }}
								</td>
							</tr>
							<tr>
								<td>Are you willing to pay the journal's fee for color reproduction?</td>
								<td>{{ $submission->color_reproduction == null ? '-' : $submission->color_reproduction == 1 ? 'Yes' : 'No' }}
								</td>
							</tr>
							<tr>
								<td>Do you have any conflict of interest?</td>
								<td>{{ $submission->conflict_of_interest == null ? '-' : $submission->conflict_of_interest == 1 ? 'Yes' . ($submission->conflict_of_interest_yes ?? ', but you have not described conflict of interest.' ): 'No' }}
								</td>
							</tr>
							<tr>
								<td>Is there a data set associated with this submission?
								</td>
								<td>{{ $submission->data_set_associated == null ? '-' : $submission->data_set_associated == 1 ? 'Yes' . ($submission->data_set_associated_yes ?? ', but you have not described data set.' ): 'No' }}
								</td>
							</tr>
							<tr>
								<td>All studies involving primary data collection from human subjects require approval
									from an institutional review board (IRB) or equivalent. If there is no IRB
									equivalent, in your country or institution, you will need to explain how you
									protected your study participants. Please select the appropriate box for your study:
								</td>
								<td>
									@if ($submission->human_subjects == null)
									-
									@endif
									@if ($submission->human_subjects == 'a')
									A. No data from human subjects were used
									@endif
									@if ($submission->human_subjects == 'b')
									B. Only secondary data were used (i.e., this study team did not collect the data but
									had access to de-identified data)
									@endif
									@if ($submission->human_subjects == 'c')
									C. Primary data were collected but there was no IRB or equivalent approval because
									that is not available in my country/institution.
									<br>
									{{ $submission->human_subjects_details_c ?? 'Not Explained' }}
									@endif
									@if ($submission->human_subjects == 'd')
									D. Primary data were collected and there was IRB or equivalent approval.
									<br>
									{{ $submission->human_subjects_details_d ?? 'Not Explained' }}
									@endif
								</td>

							</tr>
							<tr>
								<td>Comply with Bangladesh Journal of Extension Education Policies
								</td>
								<td>{{ $submission->confirm_recommendation == 1 ? 'Yes' : 'No' }}
								</td>
							</tr>

						</tbody>
					</table>
					<hr>


					<form method="POST" action="{{ route('submission.step6Post', $submission->id) }}">
						@csrf

						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="hidden" class="custom-control-input" id="status" name="status">
								<input type="hidden" class="custom-control-input" id="current_status" value="{{$current_status}}">
								<input required type="checkbox" class="custom-control-input" id="review" name="review">
									@if($current_status == 4)
    								   <label class="custom-control-label" for="review">I have reviewed my submission and want to re-submit for review.</label>
    								@else
    								    <label class="custom-control-label" for="review">I have reviewed my submission and want	to submit for review.</label>
    								@endif
								
								
							</div>
						</div>
						<div class="form-group">
							@if($current_status == 4)
							    <button id="reviewit" type="submit" class="saveform btn btn-primary float-right">Modified And Submit Again</button>
							@else
						    	<button id="draft" type="submit" class="saveform btn btn-outline-primary">Save as Draft</button>
							    <button id="reviewit" type="submit" class="saveform btn btn-primary float-right">Submit</button>
							@endif
							
					</form>
				</div>

			</div>
		</div>

	</div>
</div>
</div>
@endsection

@section('js')
<script>
	$(function () {
	$('.saveform').on('click', function (e) {
		$('#status').val(0);
		var current_status = $('#current_status').val();
		if($(this).prop('id') == 'reviewit'){
			console.log('Inside reviewit');
		    if(current_status == 4){
				$('#status').val(6);
			}else if(current_status == 0){
				$('#status').val(5);
			}	
		}		
		// console.log($('#status').val());		
		// e. preventDefault();		
		// return false;
	});
});
</script>

@endsection