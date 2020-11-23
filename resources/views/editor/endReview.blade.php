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
					<h1>Reviwers Messages</h1>

					<ol class="sj-breadcrumb ">
						<li>
							<a href="{{url('/')}}">
								Home
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								Reviwers Messages
							</a>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!--************************************
        Inner Banner Endfile_to_editor
*************************************-->
@endsection

@section('content')
<style>
    .sj-userinfoimgname{
            margin: 0 0 15px;
            clear: both;
            overflow: hidden;
            border: 1px solid #ddd;
            padding: 25px;
    }
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

	.reviewer-comments-in-editor .status {
		width: 135px;
		text-align: center;
		padding: 5px;
		border: 1px solid #4AD38F;
		color: #4AD38F;
		margin: -5px 5px;
	}

	.reviewer-comments-in-editor .status.good,
	.reviewer-comments-in-editor .status.very-good,
	.reviewer-comments-in-editor .status.excelence {
		border: 1px solid #4AD38F;
		color: #4AD38F;
	}

	.reviewer-comments-in-editor .status.bad,
	.reviewer-comments-in-editor .status.vary-bad {
		border: 1px solid #f00;
		color: #f00;
	}

	.pull-right.send-to-span {
		display: flex;
		margin-bottom: 0;
		justify-content: center;
		align-items: center;
		padding: 5px 8px;
		border-radius: 3px;
	}

	.pull-right.send-to-span input {
		margin-right: 5px;
		position: relative;
		transform: translateY(0px);
	}

	.pull-right.send-to-span label {
		margin: 0;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Editor Remark on <strong>{{ str_limit($journal_info->title, 24) }}</strong></div>
				<div class="card-body">
					<form enctype="multipart/form-data" action="{{ url('editor/end-review-save') }}" method="post">
					<input type="hidden" name="journal_id" value="{{ $journal_info->journalId }}">
					<?php
						$toDay = Carbon\Carbon::now();
					?>
					<input type="hidden" name="modif_start_date" value="{{ $toDay }}">
						@csrf
						<div class="form-group">
							<label for="verdict">
								Remark Project by Selecting on of the following options
							</label>
							<select required class="form-control" id="verdict" name="verdict">
								<option value="">Select ... </option>
								<option value="3" <?php if($journal_info->status == 3) echo "selected";?> >Accept</option>
								<option value="2" <?php if($journal_info->status == 2)echo "selected";?> >Reject</option>
								<option value="4" <?php if($journal_info->status == 4)echo "selected";?> >Require Modification</option>
							</select>
						</div>

						
						<div class="form-group modification_deadline_form_group" style="display: none;">
							<label for="modification_deadline">Modification Deadline</label>
							<input type="date" class="form-control datepicker" id="modification_deadline" name="modification_deadline" placeholder="dd-mm-yyyy">
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

					{{-- </form> --}}
				</div>
			</div>
		</div>

		<div class="col-md-8">

			<div class="card">
				<div class="card-header">Review Details of <strong>{{ str_limit($journal_info->title, 80) }}</strong></div>
				<div class="card-body">
					<div class="sj-userinfoname w-100">
						<h3 style="line-height: 1.4;">{{ $journal_info->title }}</h3>
						<hr>
					</div>

					

					<ul id="accordion" class="sj-articledetails sj-articledetailsvtwo sj-addarticleholdcontent reviewer-comments-to-them reviewer-comments-in-editor">
						<!-- Reviewer-1 -->
						
					
						@foreach ($reviewDetails as $r_d)
						
							<li id="headingOne" class="sj-articleheader" data-toggle="collapse" data-target="#collapse{{$r_d['reviewerId']}}" aria-expanded="false" aria-controls="collapseOne">
								<div class="sj-detailstime">
									<h4>
										
										Messages of Reviewer ({{ $r_d['reviewerName'] }})
										<b class="pull-right">
										<span class="status good">{{ array_key_exists("reviewerRating",$r_d) ? $r_d['reviewerRating'] : 'No Review' }}</span>
											<i class="fa fa-angle-down"></i>
										</b>
									</h4>
								</div>
							</li>
						
							<li id="collapse{{ $r_d['reviewerId'] }}" class="collapse sj-active sj-userinfohold" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="sj-userinfoimgname">
									<div class="sj-userinfoname w-100">
										<h3 style="line-height: 1.4;">
											Message To Editor
											<span class="pull-right send-to-span">
												{{-- <input type="checkbox" name="send-to-author" id="send-to-author11">
												<label href="#" for="send-to-author11">
													Send To Author
												</label> --}}
											</span>
										</h3>
										<hr>
									</div>
	
									<div class="sj-description modification-mesages">
										{{ array_key_exists("comments_to_editor",$r_d) ? $r_d['comments_to_editor']:'No Review' }}
									</div>
	
									<div class="clear-both" style="clear:both;"></div>
	
									<div class="sj-downloadheader">
										<div class="sj-title">
											<h3>Attached Document</h3>
											@if(array_key_exists('file_to_editor',$r_d))
    											@if($r_d['file_to_editor'] !=null)
    											<a href="{{ route('downloadMyReview',[$journal_info->journalId,$r_d['reviewerId'],'toEditor'] ) }}"><i class="lnr lnr-download"></i>Download</a>
    											@endif
											@endif
										</div>
										<!--<div class="sj-docdetails">-->
										<!--	<figure class="sj-docimg">-->
										<!--		<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">-->
										<!--	</figure>-->
										<!--	<div class="sj-docdescription">-->
										<!--		<h4>Document Ph...01.docx</h4>-->
										<!--		<span>File Size 500kb</span>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								</div>
	
								<div class="sj-userinfoimgname">
									<div class="sj-userinfoname w-100">
										<h3 style="line-height: 1.4;">
											Message To Author
					
											@if(array_key_exists("comments_to_editor",$r_d) ? $r_d['comments_to_editor']: Null)
												<span class="pull-right send-to-span">
												<input type="checkbox" name="send-to-author[]" value="{{ $r_d['reviewerId'] }}">
												<label href="#" for="send-to-author12">
													Send To Author
												</label>
											</span>
											@endif
										</h3>
										<hr>
									</div>
	
									<div class="sj-description modification-mesages">
							
										{{ array_key_exists("comments_to_editor",$r_d) ? $r_d['comments_to_editor']:'No Review' }}
									</div>
	
									<div class="clear-both" style="clear:both;"></div>
	
									<div class="sj-downloadheader">
										<div class="sj-title">
											<h3>Attached Document</h3>
											@if(array_key_exists('file_to_author',$r_d))
    											@if($r_d['file_to_author'] !='')
    											<a href="{{ route('downloadMyReview',[$journal_info->journalId,$r_d['reviewerId'],'toAuthor'] ) }}"><i class="lnr lnr-download"></i>Download</a>
    											@endif
    										@endif	
										</div>
										<!--<div class="sj-docdetails">-->
										<!--	<figure class="sj-docimg">-->
										<!--		<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">-->
										<!--	</figure>-->
										<!--	<div class="sj-docdescription">-->
										<!--		<h4>Document Ph...01.docx</h4>-->
										<!--		<span>File Size 500kb</span>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								</div>
	
							</li>
							
						@endforeach
						
						
						<!-- Reviewer-1 closed -->

						{{-- <!-- Reviewer-2 -->
						<li id="headingtwo" class="sj-articleheader" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
							<div class="sj-detailstime">
								<h4>
									Messages of Reviewer 2
									<b class="pull-right">
										<span class="status excelent">Excelent</span>
										<i class="fa fa-angle-down"></i>
									</b>
								</h4>
							</div>
						</li>

						<li id="collapsetwo" class="collapse sj-active sj-userinfohold" aria-labelledby="headingtwo" data-parent="#accordion">
							<div class="sj-userinfoimgname">
								<div class="sj-userinfoname w-100">
									<h3 style="line-height: 1.4;">
										Message To Editor
										<span class="pull-right send-to-span">
											<input type="checkbox" name="send-to-author" id="send-to-author21">
											<label href="#" for="send-to-author21">
												Send To Author
											</label>
										</span>
									</h3>
									<hr>
								</div>

								<div class="sj-description modification-mesages">
									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>

									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
								</div>

								<div class="clear-both" style="clear:both;"></div>

								<div class="sj-downloadheader">
									<div class="sj-title">
										<h3>Attached Document</h3>
										<a href="javascript:void(0);"><i class="lnr lnr-download"></i>Download</a>
									</div>
									<div class="sj-docdetails">
										<figure class="sj-docimg">
											<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">
										</figure>
										<div class="sj-docdescription">
											<h4>Document Ph...01.docx</h4>
											<span>File Size 500kb</span>
										</div>
									</div>
								</div>
							</div>

							<div class="sj-userinfoimgname">
								<div class="sj-userinfoname w-100">
									<h3 style="line-height: 1.4;">
										Message To Author
										<span class="pull-right send-to-span">
											<input type="checkbox" name="send-to-author" id="send-to-author22">
											<label href="#" for="send-to-author22">
												Send To Author
											</label>
										</span>
									</h3>
									<hr>
								</div>

								<div class="sj-description modification-mesages">
									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>

									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
								</div>

								<div class="clear-both" style="clear:both;"></div>

								<div class="sj-downloadheader">
									<div class="sj-title">
										<h3>Attached Document</h3>
										<a href="javascript:void(0);"><i class="lnr lnr-download"></i>Download</a>
									</div>
									<div class="sj-docdetails">
										<figure class="sj-docimg">
											<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">
										</figure>
										<div class="sj-docdescription">
											<h4>Document Ph...01.docx</h4>
											<span>File Size 500kb</span>
										</div>
									</div>
								</div>
							</div>
						</li>
						<!-- Reviewer-2 closed -->

						<!-- Reviewer-3 -->
						<li id="headingthree" class="sj-articleheader" data-toggle="collapse" data-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
							<div class="sj-detailstime">
								<h4>
									Messages of Reviewer 3
									<b class="pull-right">
										<span class="status bad">Bad</span>
										<i class="fa fa-angle-down"></i>
									</b>
								</h4>
							</div>
						</li>

						<li id="collapsethree" class="collapse sj-active sj-userinfohold" aria-labelledby="headingthree" data-parent="#accordion">
							<div class="sj-userinfoimgname">
								<div class="sj-userinfoname w-100">
									<h3 style="line-height: 1.4;">
										Message To Editor
										<span class="pull-right send-to-span">
											<input type="checkbox" name="send-to-author" id="send-to-author31">
											<label href="#" for="send-to-author31">
												Send To Author
											</label>
										</span>
									</h3>
									<hr>
								</div>

								<div class="sj-description modification-mesages">
									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>

									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
								</div>

								<div class="clear-both" style="clear:both;"></div>

								<div class="sj-downloadheader">
									<div class="sj-title">
										<h3>Attached Document</h3>
										<a href="javascript:void(0);"><i class="lnr lnr-download"></i>Download</a>
									</div>
									<div class="sj-docdetails">
										<figure class="sj-docimg">
											<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">
										</figure>
										<div class="sj-docdescription">
											<h4>Document Ph...01.docx</h4>
											<span>File Size 500kb</span>
										</div>
									</div>
								</div>
							</div>

							<div class="sj-userinfoimgname">
								<div class="sj-userinfoname w-100">
									<h3 style="line-height: 1.4;">
										Message To Author
										<span class="pull-right send-to-span">
											<input type="checkbox" name="send-to-author" id="send-to-author32">
											<label href="#" for="send-to-author32">
												Send To Author
											</label>
										</span>
									</h3>
									<hr>
								</div>

								<div class="sj-description modification-mesages">
									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>

									<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etnalo doloreae magna aliqua enim ad minim veniam quis natrud exercitation ullamco laboris nisi utna aliquip amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
								</div>

								<div class="clear-both" style="clear:both;"></div>

								<div class="sj-downloadheader">
									<div class="sj-title">
										<h3>Attached Document</h3>
										<a href="javascript:void(0);"><i class="lnr lnr-download"></i>Download</a>
									</div>
									<div class="sj-docdetails">
										<figure class="sj-docimg">
											<img src="http://bjee.com.bd/public/theme/images/thumbnails/doc-img.jpg" alt="img description">
										</figure>
										<div class="sj-docdescription">
											<h4>Document Ph...01.docx</h4>
											<span>File Size 500kb</span>
										</div>
									</div>
								</div>
							</div>
						</li> --}}
						<!-- Reviewer-3 closed -->

					</ul>
				</div>
			</div>

			<hr>
		</div>

	</form>
	</div>
</div>
@endsection



@section('js')
<script>
	$(document).ready(function() {
		$(document).on('change', '#verdict', function() {
			if ($(this).val() == "4") {
				$(".modification_deadline_form_group").show();
			} else {
				$(".modification_deadline_form_group").hide();
			}
		});
	});
</script>
@endsection