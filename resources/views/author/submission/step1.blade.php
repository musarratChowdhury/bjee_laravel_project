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
							class="list-group-item list-group-item-action active">Step 1: Manuscript Data</a>
						<a href="{{ route('submission.step3', $submission->id) }}"
						    class="list-group-item list-group-item-action">Step 2: Keywords</a>
						<a href="{{ route('submission.step2', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 3: File Upload</a>
						<a href="{{ route('submission.step4', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 4: Authors & Institutions</a>
						<a href="{{ route('submission.step5', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 5: Additional Information</a>
						<a href="{{ route('submission.step6', $submission->id) }}"
							class="list-group-item list-group-item-action">Step 6: Review & Submit</a>
					</div>

				</div>
			</div>


		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Step 1: Manuscript Data
				</div>
				<div class="card-body">
					<!--<p class="card-text">Select your manuscript type. Enter your title, running head, and abstract into-->
					<!--	the appropriate boxes below. If you need to insert a special character, click the "Special-->
					<!--	Characters" button. When you are finished, click "Save and Continue."-->
					<!--	These files will be combined into a single PDF document for the peer review process. If you are-->
					<!--	submitting a revision, please include only the latest set of files. If you have updated a file,-->
					<!--	please delete the original version and upload the revised file. To designate the order in which-->
					<!--	your files appear, use the dropdowns in the "order" column below. View your uploaded files by-->
					<!--	clicking on HTML or PDF. When you are finished, click "Save and Continue." Please be sure all-->
					<!--	files are in the correct format and comply with our word limits.</p>-->
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
					<!--<hr>-->

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

					<form enctype="multipart/form-data" action="{{ route('submission.step1Post', $submission->id) }}"
						method="post">
						@csrf
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title"
								placeholder="Give your Submission a Title" value="{{ $submission->title ?? '' }}">
						</div>
						<div class="form-group">
							<label for="type">Type</label>
							<select class="form-control" id="type" name="type">
								<option value="">Select ... </option>
								@foreach ($types as $type)
								<option {{ $submission->type == $type->id ? 'selected' : '' }} value="{{ $type->id }}">
									{{ $type->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="runninghead">Running Head</label>
							<!--<textarea class="form-control" id="runninghead" name="runninghead"-->
							<!--	rows="3">{{ $submission->running_head ?? '' }}</textarea>-->
							<input type="text" class="form-control" id="runninghead" name="runninghead"
						        placeholder="Give your Running Head" value="{{ $submission->running_head ?? '' }}">
						</div>

						<div class="form-group">
							<label for="abstract">Abstract</label>
							<textarea class="form-control" id="abstract" name="abstract"
								rows="3">{{ $submission->abstract ?? '' }}</textarea>
						</div>
						
						<div class="form-group">
    						<label for="number_of_words">Number of Words</label>
    						<input value="{{ $submission->number_of_words ?? '' }}" type="text" class="form-control"
    							id="number_of_words" name="number_of_words">
						</div>

						<div class="form-group">
							<label class="font-weight-bold" for="special_issue">
								Is the manuscript a candidate for a special issue?
							</label><br>
							<div class="custom-control custom-radio">
								<input {{ $submission->special_issue > 0 ? 'checked' : null }} value="1" type="radio"
									id="special_issue_yes" name="special_issue" class="custom-control-input">
								<label class="custom-control-label" for="special_issue_yes">Yes</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $submission->special_issue === 0 ? 'checked' : null }} value="0" type="radio"
									id="special_issue_no" name="special_issue" class="custom-control-input">
								<label class="custom-control-label" for="special_issue_no">No</label>
							</div>
							<br>
							<label for="special_issue_title">If yes, what is the title of the special issue:
								<input type="text" class="form-control" id="spIssueDesc" name="spIssueDesc"
						        placeholder="Special Issue" value="{{ $submission->sp_issue_description ?? '' }}">
						
							</label>

						</div>

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
</div>
@endsection