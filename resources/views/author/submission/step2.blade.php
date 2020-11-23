@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">



		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<!--<a href="{{ route('submission.step1', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 1: Manuscript Data</a>-->
						<!--<a href="{{ route('submission.step2', $submission->id) }}"-->
						<!--    class="list-group-item list-group-item-action">Step 2: Keywords</a>-->
						<!--<a href="{{ route('submission.step3', $submission->id) }}"-->
						<!--    class="list-group-item list-group-item-action active">Step 3: File Upload</a>-->
						<!--<a href="{{ route('submission.step4', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 4: Authors & Institutions</a>-->
						<!--<a href="{{ route('submission.step5', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 5: Additional Information</a>-->
						<!--<a href="{{ route('submission.step6', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 6: Review & Submit</a>-->
						
						<a href="{{ route('submission.step1', $submission->id) }}"
						    class="list-group-item list-group-item-action">Step 1: Manuscript Data</a>
						<a href="{{ route('submission.step3', $submission->id) }}"
						    class="list-group-item list-group-item-action">Step 2: Keywords</a>
						<a href="{{ route('submission.step2', $submission->id) }}"
							class="list-group-item list-group-item-action active">Step 3: File Upload</a>
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
				<div class="card-header">Step 3: File Upload</div>
				<div class="card-body">
					<!--<p class="card-text">Upload as many files as needed for your manuscript in groups of three or fewer.-->
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
					<h3>Files</h3>

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
							@forelse ($files as $file)
							<tr>
								<td> <a onclick="return confirm('Are you sure?');"
										href="{{ route('submission.step2DeleteFile',[$submission->id, $file->id] ) }}">
										Delete File</a> </td>
								<td>
									<a target="_blank"
										href="{{ route('submission.step2DownloadWord',[$submission->id, $file->id, $file->word] ) }}">
										MSWord
									</a> |
									<a target="_blank"
										href="{{ route('submission.step2DownloadPDF',[$submission->id, $file->id, $file->pdf]) }}">
										PDF
									</a>
								</td>
								<td>{{ $file->updated_at }}</td>
								<td>{{ $file->user->name }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-center">No files Added yet</td>
							</tr>
							@endforelse

						</tbody>
					</table>

					<hr>
					<h3>Main File Upload</h3>

					<form enctype="multipart/form-data" action="{{ route('submission.step2Upload',$submission->id) }}"
						method="POST">
						@csrf

						<div class="form-row">
							<div class="form-group col-12">
								<label for="pdf">Add Pdf Version</label>
								<input accept="application/pdf" type="file" class="form-control-file" id="pdf"
									name="pdf">
								@error('pdf')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<label for="word">Add MSWord Version</label>
								<input accept=".doc,.docx,application/msword,
								application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" class="form-control-file"
									id="word" name="word">
								@error('word')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
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
@endsection