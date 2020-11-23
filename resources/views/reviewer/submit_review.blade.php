@extends('layouts.new')
@section('homebanner')
<!--************************************
        Inner Banner Start
*************************************-->
<div class="sj-innerbanner">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sj-innerbannercontent">
					<h1>Review Submission</h1>

					<ol class="sj-breadcrumb ">
						<li>
							<a href="{{url('/')}}">
								Home
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								Review Submission
							</a>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!--************************************
        Inner Banner End
*************************************-->
@endsection
@section('content')
<style>
	.reviewer-comments-to-them {
		box-shadow: none;
		margin-bottom: 1rem;
	}

	.reviewer-comments-to-them>li {
		min-height: auto;
		padding: 0 20px;
	}

	.reviewer-comments-to-them>li .sj-userinfoimgname {
		padding-left: 20px;
	}

	.reviewer-comments-to-them>li .sj-detailstime {
		width: inherit;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					Review: <strong>{{ str_limit($reviewer->submission->title, 28) }}</strong>
				</div>

				<div class="card-body">
					<form enctype="multipart/form-data" action="{{ route('reviewer.submitReview', $submissionId) }}" method="post">
						@csrf
						<p>
							Title : <strong>{{ $reviewer->submission->title }} </strong><br>
						</p>
						<p>
							Created Date : <strong>{{ $reviewer->submission->created_at }}</strong>
						</p>

						<div class="form-group">
							<label for="rate">Rate Your Satisfaction</label>
							<select class="form-control" id="rate" name="rating">
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

						<ul id="accordion" class="sj-articledetails sj-articledetailsvtwo sj-addarticleholdcontent reviewer-comments-to-them">
							<li id="headingOne" class="sj-articleheader" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<div class="sj-detailstime">
									<h4>
										Reviewer Comment To Editor <b class="pull-right">
											<i class="fa fa-angle-down"></i>
										</b>
									</h4>
								</div>
							</li>
							<li id="collapseOne" class="collapse sj-active sj-userinfohold" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="sj-userinfoimgname">
									<div class="form-group">
										<label for="comments">Reviewer Comments</label>
										<textarea required class="form-control" id="comments1" name="commentToEditor" rows="3" placeholder="Give your comments about Submission">{{ $myReview->comments_to_editor ?? '' }}</textarea>
									</div>

									<div class="form-row">
										<div class="form-group col-12">
											<label for="reviewfile">Upload Modifcaiton Instruction (MS word only)</label>
											<input accept=".doc,.docx,application/msword,
									application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" class="form-control-file" id="file_to_editor" name="file_to_editor">
											@error('reviewfile')
											<div class="alert alert-danger">{{ $message }}</div>
											@enderror
											
											@isset($myReview->file_to_editor)
											<a href="{{ route('downloadMyReview',[$submissionId,$reviewerId,'toEditor'] ) }}"><i class="lnr lnr-download"></i>Download Editor</a>
											@endisset
										</div>
									</div>
								</div>

							</li>
							<li id="headingtwo" class="sj-articleheader" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
								<div class="sj-detailstime">
									<h4>
										Reviewer Comment To Author <b class="pull-right">
											<i class="fa fa-angle-down"></i>
										</b>
									</h4>
								</div>
							</li>

							<li id="collapsetwo" class="collapse sj-active sj-userinfohold" aria-labelledby="headingtwo" data-parent="#accordion">
								<div class="sj-userinfoimgname">
									<div class="form-group">
										<label for="comments">Reviewer Comments</label>
										<textarea required class="form-control" id="comments2" name="commentToAuthor" rows="3" placeholder="Give your comments about Submission">{{ $myReview->comments_to_author ?? '' }}</textarea>
									</div>
									<div class="form-row">
										<div class="form-group col-12">
											<label for="reviewfile">Upload Modifcaiton Instruction (MS word only)</label>
											<input accept=".doc,.docx,application/msword,
									application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" class="form-control-file" id="file_to_author" name="file_to_author">
											@error('reviewfile')
											<div class="alert alert-danger">{{ $message }}</div>
											@enderror
											<?php
											    $status = 'toAuthor';
											?>
											@isset($myReview->file_to_author)
											<a href="{{ route('downloadMyReview',[$submissionId,$reviewerId,$status] ) }}"><i class="lnr lnr-download"></i>Download Author</a>
											<!--<a href="{{ url('/review-download/'.$submissionId.'/'.$reviewerId.'/toEditor') }}"><i class="lnr lnr-download"></i>Download Author</a>-->
											@endisset
										</div>
									</div>
								</div>
							</li>
						</ul>

		


						<div class="form-group">
							<input type="hidden" class="custom-control-input" id="status" name="status">
							<button id="draft" type="submit" class="saveform btn btn-outline-primary">Save as
								Draft</button>
							<button id="saved" type="submit" class="saveform btn btn-primary pull-right">Submit Your
								Review</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<strong>View File</strong> {{ Storage::disk('local')->get($reviewer->submission->file->pdf)}}

					<a class="float-right btn btn-sm btn-outline-dark" href="{{ route('downloadNumbered',$reviewer->submission->id ) }}">
						Download PDF
					</a>
				</div>

				<div class="card-body">
					<embed src="{{ action('ReviewerController@viewPdf', [$reviewer->submission->id, $reviewer->submission->file->id ]  ) }}" type="application/pdf" width="100%" height="750px" />

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function(){
		$('.saveform').on('click', function(e) {
			$('#status').val(0);
			if ($(this).prop('id') == 'saved') {
				$('#status').val(1);
			}
		});
	});
</script>
@endsection