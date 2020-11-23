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
                    <h1>Editor Panel</h1>
                    <ol class="sj-breadcrumb secondary-menu">
                        <li class="active">
                            <a href="javascript:void(0);">
							Submitted <sup>{{ App\Helpers\Helper::countSubmission() }}</sup>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);">
                                Published <sup>{{ App\Helpers\Helper::countSubmission('published') }}</sup>
                            </a>
                        </li> --}}
                        
                        <li>
	
						<a href="{{ url('editor/in-review') }}">
                                In Review <sup>{{ App\Helpers\Helper::countSubmission('in review') }}</sup>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('editor/technical-review') }}">
                                Technical Review <sup>{{ App\Helpers\Helper::countSubmission('technical review') }}</sup>
                            </a>
						</li>
						<li>
                            <a href="{{ url('editor/ready-to-publish') }}">
                                Ready to Publish <sup>{{ App\Helpers\Helper::countSubmission('ready to publish') }}</sup>
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
<div class="container">
	<div class="row">
		<div id="sj-twocolumns" class="sj-twocolumns">
		<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3 float-left">
				<aside id="sj-asidebar" class="sj-asidebar sj-widgetbox">
					<div class="sj-widgetprofile">
						<div class="sj-widgetcontent">
							<figure>
								<img src="{{ asset('theme/images/favicon.png') }}" alt="image description">
								<a class="sj-btnedite" href="javascript:void(0);"><i class="lnr lnr-pencil"></i></a>
							</figure>
							<div class="sj-admininfo">
								<h3>BAES</h3>
								<h4>Editor</h4>
							</div>
						</div>
					</div>
					<div class="sj-widgetdashboard">
						<nav id="sj-dashboardnav" class="sj-dashboardnav">
							<ul>
								<li><a href="{{ route('editor.submissions') }}"><i class="lnr lnr-sync"></i> <span>Manage Journal</span></a></li>
								<li><a href="javascript:void(0);"><i class="lnr lnr-briefcase"></i> <span>Manage Articles</span></a></li>
								<li><a href="{{ route('editor.reviewers') }}""><i class="lnr lnr-briefcase"></i> <span>Manage Reviewers</span></a></li>
							</ul>
						</nav>
					</div>
				</aside>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-9 float-right">
				<div id="sj-content" class="sj-content sj-addarticleholdcontent">
					<div class="sj-dashboardboxtitle sj-titlewithform">
						<h2>Submitted Journals</h2>
						<form class="sj-formtheme sj-formsearchvtwo">
							<div class="sj-sortupdown">
								<a href="javascript:void(0);"><i class="fa fa-sort-amount-up"></i></a>
							</div>
							<fieldset>
								<input type="search" name="search" class="form-control" placeholder="Search here">
								<button type="submit" class="sj-btnsearch"><i class="lnr lnr-magnifier"></i></button>
							</fieldset>
						</form>
					</div>
					<ul id="accordion" class="sj-articledetails sj-articledetailsvtwo">
						@forelse ($submissions as $submission)
						<li id="heading{{ $submission->id }}" class="sj-articleheader" data-toggle="collapse"
						data-target="#collapse{{ $submission->id }}"
						aria-expanded="true" aria-controls="collapse{{ $submission->id }}">
							<div class="sj-detailstime">
								<span><i class="ti-calendar"></i>{{ \Carbon\Carbon::parse($submission->created_at)->format('M d, Y h:i A')}}</span>
								<span><i class="ti-layers"></i>{{ $submission->submissionType->name ?? '' }}</span>
								<span><i class="ti-bookmark"></i>{{ $submission->id }}</span>
								<span><i class="ti-bookmark-alt"></i>Edition</span>
								<h4>{{ $submission->title ?? '[ No Title Given ]' }}</h4>
							</div>
							<div class="sj-nameandmail">
								<span>Corresponding Author</span>
								<h4>{{ $submission->user->name }}</h4>
								<span class="sj-mailinfo">{{ $submission->user->email }}</span>
							</div>
						</li>
						<li id="collapse{{ $submission->id }}" class="collapse sj-active sj-userinfohold" aria-labelledby="heading{{ $submission->id }}" data-parent="#accordion">
							<div class="sj-userinfoimgname">
								<figure class="sj-userinfimg">
									<img src="{{ asset('theme/images/thumbnails/img-02.jpg') }}" alt="img description">
								</figure>
								<div class="sj-userinfoname">
									<span>{{ \Carbon\Carbon::parse($submission->created_at)->diffForHumans() }}
										on {{ \Carbon\Carbon::parse($submission->created_at)->format('l \\a\\t h:i A') }}</span>
									<h3>{{ $submission->user->name }}</h3>
								</div>
								<div class="sj-userbtnarea">
									
									@if ($submission->status->name === 'draft')
										<a href="#"><button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Submission is in draft</button></a>
									@endif

									@if ($submission->status->name === 'submitted for review')
									<a href="{{ route('editor.startReview',  $submission->id) }}"><button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Start Review Process</button></a> 

									@endif

									@if ($submission->status->name === 'review in progress')
									<a href="{{ route('editor.assignReviewer',  $submission->id) }}">
										<button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Assign Reviewers<sup>02</sup></button>
									</a> 
									<a href="{{ route('editor.endReview',  $submission->id) }}">
										<button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Check Reviews</button>
									</a> 
									<a href="{{ route('editor.showSubmission',  $submission->id) }}">
										<button type="submit" class="sj-btn" data-toggle="modal" data-target="#feedbackmodal">End Review Process</button>
									</a> 
									{{-- <a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.assignReviewer',  $submission->id) }}">
										Assign Reviewers
									</a>
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.endReview',  $submission->id) }}">
										Check Reviews
									</a>
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.endReview',  $submission->id) }}">
										End Review Process
									</a> --}}
									@endif

									@if ($submission->status->name === 'rejected')
									<a href="{{ route('editor.showSubmission',  $submission->id) }}">
										<button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Submission Rejected</button>
									</a> 
									{{-- <a class="btn btn-outline-danger btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									<a class="btn btn-sm btn-outline-danger btn-block"
										onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"
										href="{{ route('deleteSubmission', $submission->id) }}">Delete
									</a> --}}
									@endif

									@if ($submission->status->name === 'accepted')
									<a href="{{ route('editor.showSubmission',  $submission->id) }}">
										<button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Submission Accepted</button>
									</a> 

									@endif

									@if ($submission->status->name === 'require modifications')
									<a href="{{ route('editor.showSubmission',  $submission->id) }}">
										<button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">require modifications</button>
									</a> 
									{{-- <a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Details
									</a> --}}
									@endif


									{{-- <a href="http://"><button type="button" class="sj-btn sj-btnactive" data-toggle="modal" data-target="#reviewermodal">Assign Reviewer<sup>02</sup></button></a>  --}}
									<button type="submit" class="sj-btn" data-toggle="modal" data-target="#feedbackmodal">Send Feedback</button>
								</div>
								<div class="sj-description">
									<p>
									
									</p>
								</div>
								<div class="sj-downloadheader">
									@if ($submission->file !== null)
									<div class="sj-title">
										<h3>Attached Document</h3>
										<a href="{{ route('submission.step2DownloadWord',[ $submission->id, $submission->file->id, $submission->file->word] ) }}"><i class="lnr lnr-download"></i>Download</a>
										<a href="{{ route('editor.showSubmission',$submission->id ) }}"><i class="lnr "></i>View Details</a>
									</div>
									<div class="sj-docdetails">
										<!--<figure class="sj-docimg">-->
										<!--	<img src="{{ asset('theme/images/thumbnails/doc-img.jpg') }}" alt="img description">-->
										<!--</figure>-->
										<!--<div class="sj-docdescription">-->
										<!--	<h4>Document Ph...01.docx</h4>-->
										<!--	<span>File Size 500kb</span>-->
										<!--</div>-->
									</div>
									@else
									<div class="sj-title">
										<h3>No File Given</h3>
										<a href="javascript:void(0);"><i class="lnr lnr-download"></i>Download</a>
										<a href="{{ route('editor.showSubmission',  $submission->id) }}"><i class="lnr "></i>View Details</a>
									</div>									
									@endif
									
								</div>
							</div>
						</li>
						@empty
							
						@endforelse
							
						

					</ul>
					{{ $submissions->links() }}
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('contentold')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">All Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('editor.submissions') }}"
							class="list-group-item list-group-item-action active">
							All Submissions
						</a>
						<a href="{{ route('editor.reviewers') }}" class="list-group-item list-group-item-action">
							Reviewers
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Submissions</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>Id</th>
								<th>Submitted by</th>
								<th>Title</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($submissions as $submission)
							<tr>
								<td>
									{{ $submission->id }}
									<br>

								</td>
								<td> <a href="#">{{ $submission->user->name }}</a> </td>

								<td>
									{{ $submission->title ?? '(No Title Entered)' }}
								</td>


								<td> {{ $submission->created_at }} </td>

								<td>

									<span class="badge badge-dark">{{ $submission->status->name }}</span>

								</td>


								<td>

									{{-- @if ($submission->file)
									<a class="btn btn-outline-dark btn-sm btn-block"
									href="{{ route('editor.showfile',  [$submission->id, $submission->file->id]) }}">
									Showfile
									</a>
									@endif --}}
									
									@if (
									$submission->status->name === 'draft' ||
									$submission->status->name === 'review in progress'
									)

									@role('author')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('submissions.show',  $submission->id) }}">
										View Submission Details
									</a>
									@endrole

									@role('editor|superadmin')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									@endrole

									@endif

									@if ($submission->status->name === 'submitted for review')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.startReview',  $submission->id) }}">
										Start Review Process
									</a>
									@endif

									@if ($submission->status->name === 'review in progress')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.assignReviewer',  $submission->id) }}">
										Assign Reviewers
									</a>
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.endReview',  $submission->id) }}">
										Check Reviews
									</a>
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.endReview',  $submission->id) }}">
										End Review Process
									</a>
									@endif

									@if ($submission->status->name === 'rejected')
									<a class="btn btn-outline-danger btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									<a class="btn btn-sm btn-outline-danger btn-block"
										onclick="return confirm('Are you sure?\nNote: This will completely delete the submission.');"
										href="{{ route('deleteSubmission', $submission->id) }}">Delete
									</a>
									@endif

									@if ($submission->status->name === 'accepted')
									<a class="btn btn-outline-success btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Submission Details
									</a>
									@endif

									@if ($submission->status->name === 'require modifications')
									<a class="btn btn-outline-dark btn-sm btn-block"
										href="{{ route('editor.showSubmission',  $submission->id) }}">
										View Details
									</a>
									@endif

								</td>
								@empty
							<tr>
								<td colspan="6" class="text-center">No files Added yet</td>
							</tr>
							@endforelse

						</tbody>
					</table>
				</div>

				<div class="card-footer">
					{{ $submissions->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection