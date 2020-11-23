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
							class="list-group-item list-group-item-action active">Step 5: Additional Information</a>
						<a href="{{ route('submission.step6', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 6: Review & Submit</a>
					</div>

				</div>
			</div>


		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Step 5: Details & Comments</div>

				<div class="card-body">
					<!--<p class="card-text">-->
					<!--	Enter or paste your cover letter text into the "Cover Letter" box below. If you would like to-->
					<!--	attach a file containing your cover letter, click the "Browse..." button, locate your file, and-->
					<!--	click "Attach this Cover Letter." Answer any remaining questions appropriately. When you are-->
					<!--	finished, click "Save and Continue."-->
					<!--</p>-->

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
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Please fix the following issue </strong><br><br>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<!--<hr>-->


					<form enctype="multipart/form-data" action="{{ route('submission.step5Post', $submission->id) }}"
						method="post">
						@csrf
						<div class="form-group">
							<label for="cover_letter">Cover Letter</label>
							<textarea class="form-control" id="cover_letter"
								name="cover_letter">{{ $submission->cover_letter ?? '' }}</textarea>
						</div>

						<div class="form-group">
							<label class="font-weight-bold" for="funding">Funding
								Is There Funding To Report For This Submission?
							</label>
							<div class="custom-control custom-radio">
								<input {{ $submission->funding === 1 ? 'checked' : null }} value="1" type="radio"
									id="funding_yes" name="funding" class="custom-control-input">
								<label class="custom-control-label" for="funding_yes">
									Yes
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->funding === 0 ? 'checked' : null }} value="0" type="radio"
									id="funding_no" name="funding" class="custom-control-input">
								<label class="custom-control-label" for="funding_no">
									No
								</label>
							</div>
							<br>
							<label for="special_issue_title">If yes, what is the source of the funding:
								<input type="text" class="form-control" id="fundingDesc" name="fundingDesc"
						        placeholder="Funding Source" value="{{ $submission->funding_description ?? '' }}">
						
							</label>
						</div>


						{{-- <div class="form-group">
							<label for="number_of_figures">Number of Figures</label>
							<input value="{{ $submission->number_of_figures ?? '' }}" type="text" class="form-control"
								id="number_of_figures" name="number_of_figures">
						</div>

						<div class="form-group">
							<label for="number_of_color_figures">Number of Color Figures</label>
							<input value="{{ $submission->number_of_color_figures ?? '' }}" type="text"
								class="form-control" id="number_of_color_figures" name="number_of_color_figures">
						</div>

						<div class="form-group">
							<label for="number_of_tables">Number of Tables</label>
							<input value="{{ $submission->number_of_tables ?? '' }}" type="text" class="form-control"
								id="number_of_tables" name="number_of_tables">
						</div> --}}

						<!--<div class="form-group">-->
						<!--	<label for="number_of_words">Number of Words</label>-->
						<!--	<input value="{{ $submission->number_of_words ?? '' }}" type="text" class="form-control"-->
						<!--		id="number_of_words" name="number_of_words">-->
						<!--</div>-->

						<div class="form-group">
							<label class="font-weight-bold" for="manuscript_previously">
								Has this manuscript been submitted previously to this journal?
							</label><br>
							<div class="custom-control custom-radio">
								<input {{ $submission->manuscript_previously === 1 ? 'checked' : null }} value="1"
									type="radio" id="manuscript_previously_yes" name="manuscript_previously"
									class="custom-control-input">
								<label class="custom-control-label" for="manuscript_previously_yes">Yes</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->manuscript_previously === 0 ? 'checked' : null }} value="0"
									type="radio" id="manuscript_previously_no" name="manuscript_previously"
									class="custom-control-input">
								<label class="custom-control-label" for="manuscript_previously_no">No</label>
							</div>

						</div>

						{{-- 					

						<div class="form-group">
							<label class="font-weight-bold" for="color_reproduction">Are you willing to pay the
								journal's fee for color
								reproduction?
								<br>
								<small>(Please check the instructions to authors, which can be reached via the
									'Instructions
									and Forms' link at the top right of this page, for details.)</small>
							</label>
							<div class="custom-control custom-radio">
								<input {{ $submission->color_reproduction === 1 ? 'checked' : null }} value="1"
									type="radio" id="color_reproduction_yes" name="color_reproduction"
									class="custom-control-input">
								<label class="custom-control-label" for="color_reproduction_yes">Yes</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->color_reproduction === 0 ? 'checked' : null }} value="0"
									type="radio" id="color_reproduction_no" name="color_reproduction"
									class="custom-control-input">
								<label class="custom-control-label" for="color_reproduction_no">No</label>
							</div>
						</div>

						

						<div class="form-group">
							<label class="font-weight-bold" for="data_set_associated">Is there a data set associated
								with this
								submission?
								<br>
								<small>Authors are encouraged to share the data un
									derlying their study. For more information
									see this journal’s Instructions for Authors</small>
							</label>
							<div class="custom-control custom-radio">
								<input {{ $submission->data_set_associated === 1 ? 'checked' : null }} value="1"
									type="radio" id="data_set_associated_yes" name="data_set_associated"
									class="custom-control-input">
								<label class="custom-control-label" for="data_set_associated_yes">
									Yes
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->data_set_associated === 0 ? 'checked' : null }} value="0"
									type="radio" id="data_set_associated_no" name="data_set_associated"
									class="custom-control-input">
								<label class="custom-control-label" for="data_set_associated_no">
									No
								</label>
							</div>

							<br>
							<label for="data_set_associated_yes">If yes, Please State Dataset</label>
							<textarea class="form-control" id="data_set_associated_yes"
								name="data_set_associated_yes">{{ $submission->data_set_associated_yes ?? '' }}</textarea>
						</div>
						 --}}
						 
						 <div class="form-group">
							</label>
							<label class="font-weight-bold" for="conflict">Do you have any conflict of interest?</label>

							<div class="custom-control custom-radio">
								<input {{ $submission->conflict_of_interest === 1 ? 'checked' : null }} value="1"
									type="radio" id="conflict_yes" name="conflict_of_interest"
									class="custom-control-input">
								<label class="custom-control-label" for="conflict_yes">
									Yes
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->conflict_of_interest === 0 ? 'checked' : null }} value="0"
									type="radio" id="conflict_no" name="conflict_of_interest"
									class="custom-control-input">
								<label class="custom-control-label" for="conflict_no">
									No
								</label>
							</div>


							<br>
							<label for="conflict_yes">If yes, Please State Conflict of Interest(s)</label>
							<textarea class="form-control" id="conflict_yes_details"
								name="conflict_of_interest_yes">{{ $submission->conflict_of_interest_yes ?? '' }}</textarea>
						</div>

						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input {{ $submission->confirm_recommendation === 1 ? 'checked' : null }}
									name="confirm_recommendation" value="1" type="checkbox" class="custom-control-input"
									id="confirm_recommendation">
								<label class="custom-control-label font-weight-bold" for="confirm_recommendation">
									Bangladesh Journal of Extension Education (BJEE)  
									strongly recommend that authors save and retain their own
									copies of
									any
									manuscript files uploaded for peer review. Should your manuscript be accepted
									for
									publication, you may need a copy of your Accepted Manuscript* files for future
									use,
									eg.
									posting to repositories in order to comply with research funder
									policies.</label>
								<br>
								<small>Please check this box to confirm that you have read and understood this
									recommendation.</small>
								<br>
								<small>*Your ‘Accepted Manuscript’ is defined as your paper, revised following peer
									review, and in the form accepted for publication by the journal editor: as
									defined
									by the National Information Standards Organization</small>
							</div>
						</div>

						{{-- <div class="form-group">
							<label class="font-weight-bold" for="human_subject">
								All studies involving primary data collection from human subjects require approval
								from
								an institutional review board (IRB) or equivalent. If there is no IRB equivalent, in
								your country or institution, you will need to explain how you protected your study
								participants. Please select the appropriate box for your study:
							</label>

							<div class="custom-control custom-radio">
								<input {{ $submission->human_subjects == 'a' ? 'checked' : null }} value="a"
									type="radio" id="human_subject_a" name="human_subjects"
									class="custom-control-input">
								<label class="custom-control-label" for="human_subject_a">
									A. No data from human subjects were used
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->human_subjects == 'b' ? 'checked' : null }} value="b"
									type="radio" id="human_subject_b" name="human_subjects"
									class="custom-control-input">
								<label class="custom-control-label" for="human_subject_b">
									B. Only secondary data were used (i.e., this study team did not collect the data
									but
									had
									access to de-identified data)
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->human_subjects == 'c' ? 'checked' : null }} value="c"
									type="radio" id="human_subject_c" name="human_subjects"
									class="custom-control-input">
								<label class="custom-control-label" for="human_subject_c">
									C. Primary data were collected but there was no IRB or equivalent approval
									because
									that
									is not available in my country/institution.
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->human_subjects == 'd' ? 'checked' : null }} value="d"
									type="radio" id="human_subject_d" name="human_subjects"
									class="custom-control-input">
								<label class="custom-control-label" for="human_subject_d">
									D. Primary data were collected and there was IRB or equivalent approval.
								</label>
							</div>

							<br>
							<label for="human_subjects_details_c">
								<small>If you answered C above, please detail how you protected your study
									participants.</small>
							</label>
							<textarea class="form-control" id="human_subjects_details_c"
								name="human_subjects_details_c">{{ $submission->human_subjects_details_c ?? '' }}</textarea>
							<br>
							<label for="human_subjects_details_d">
								<small>If you answered D above, please give date.</small>
							</label>
							<input type="date" value="{{ $submission->human_subjects_details_d ?? null }}"
								id="human_subjects_details_d" name="human_subjects_details_d" class="form-control">
						</div> --}}




						<div class="form-group">
							<button type="submit" name="draft" class="btn btn-outline-primary">Save as
								Draft</button>
							<button type="submit" name="conti" class="btn btn-primary float-right">Save and Continue</button>
						</div>

					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection