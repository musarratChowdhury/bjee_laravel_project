@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					Review <strong>{{ $reviewer->submission->title }}</strong>
				</div>

				<div class="card-body">
					<p>
						Title : <strong>{{ $reviewer->submission->title }} </strong><br>
						<!--Author : <strong>{{ $reviewer->submission->user->name }} </strong><br>-->
						Created Date : <strong>{{ $reviewer->submission->created_at }}</strong>
					</p>
					{{-- <p>Download Main File :
						<a class="btn btn-sm btn-outline-dark"
							href="{{ route('submission.step2DownloadWord',[$reviewer->submission->id, $reviewer->submission->file->id, $reviewer->submission->file->pdf] ) }}">
					PDF Version
					</a>
					<a class="btn btn-sm btn-outline-dark"
						href="{{ route('submission.step2DownloadWord',[$reviewer->submission->id, $reviewer->submission->file->id, $reviewer->submission->file->word] ) }}">
						Word Version
					</a>
					</p> --}}
					<form enctype="multipart/form-data" action="{{ route('reviewer.submitReview', $submissionId) }}"
						method="post">
						@csrf
						<div class="form-group">
							<label for="rate">Rate Your Satisfaction</label>
							<select required class="form-control" id="rate" name="rating">
								<option value="">Select ... </option>
								@foreach ($ratings as $rating)
								<option
								@isset($myReview->rating)
								{{ $myReview->rating == $rating->id ? 'selected' : null }}
								@endisset
									value="{{ $rating->id }}">{{ $rating->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="comments">Reviewer Comments</label>
							<textarea required class="form-control" id="comments" name="comments" rows="3"
								placeholder="Give your comments about Submission">{{ $myReview->comments ?? '' }}</textarea>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<label for="reviewfile">Upload Modifcaiton Instruction (MS word only)</label>
								<input accept=".doc,.docx,application/msword,
									application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" class="form-control-file"
									id="reviewfile" name="reviewfile">
								@error('reviewfile')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<input type="hidden" class="custom-control-input" id="status" name="status">
							<button id="draft" type="submit" class="saveform btn btn-outline-primary btn-block">Save as
								Draft</button>
							<button id="saved" type="submit" class="saveform btn btn-primary btn-block">Submit Your
								Review</button>
						</div>

					</form>

				</div>

				<div class="card-footer">

				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					View File {{ Storage::disk('local')->get($reviewer->submission->file->pdf)}}

					<a class="float-right btn btn-sm btn-outline-dark"
						href="{{ route('downloadNumbered',$reviewer->submission->id ) }}">
						Download PDF
					</a>

					<!--<a class="float-right btn btn-sm btn-outline-dark mr-2"-->
					<!--	href="{{ route('downloadPdf',[$reviewer->submission->id, $reviewer->submission->file->id] ) }}">-->
					<!--	Download PDF Version-->
					<!--</a>-->


				</div>

				<div class="card-body">
					<embed
						src="{{ action('ReviewerController@viewPdf', [$reviewer->submission->id, $reviewer->submission->file->id ]  ) }}"
						type="application/pdf" width="100%" height="750px" />

				</div>

				<div class="card-footer">

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
		if($(this).prop('id') == 'saved'){
			$('#status').val(1);
		}				
		});	
	});

</script>
@endsection