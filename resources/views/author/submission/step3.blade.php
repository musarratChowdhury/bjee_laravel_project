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
						<!--<a href="{{ route('submission.step3', $submission->id) }}"-->
						<!--    class="list-group-item list-group-item-action">Step 2: Keywords</a>-->
						<!--<a href="{{ route('submission.step2', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action active">Step 3: File Upload</a>-->
						<!--<a href="{{ route('submission.step4', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 4: Authors & Institutions</a>-->
						<!--<a href="{{ route('submission.step5', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 5: Additional Information</a>-->
						<!--<a href="{{ route('submission.step6', $submission->id) }}"-->
						<!--	class="list-group-item list-group-item-action">Step 6: Review & Submit</a>-->
						
						<a href="{{ route('submission.step1', $submission->id) }}"
						    class="list-group-item list-group-item-action">Step 1: Manuscript Data</a>
						<a href="{{ route('submission.step3', $submission->id) }}"
						    class="list-group-item list-group-item-action active">Step 2: Keywords</a>
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
				<div class="card-header">Step 2: Keywords</div>
				<div class="card-body">
					<!--<p class="card-text">-->
					<!--	You may enter your manuscript attributes/keywords in three different ways: type your keywords-->
					<!--	into the boxes, search the journal's list of keywords by typing in a term and clicking "Search"-->
					<!--	or select your keywords from the list (Control-Click to select multiple words) and click "Add".-->
					<!--	When you are finished, click "Save and Continue." You must enter at least three keywords.-->
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
					<h3>Keywords</h3>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th width="20" scope="col">Actions</th>
								{{-- <th scope="col">{{ $keyword->keyword->name }}Actions</th> --}}
							</tr>
						</thead>
						<tbody id="sortable" class="keyword-list-tbody">
							@forelse ($submission_keywords as $key=>$keyword)
							<tr class="ui-state-default ui-sortable-handle">
								<td>{{ ++$key }}</td>
								<td>{{ $keyword->keyword->name }}</td>
								<td>
									<button data-id="{{ $keyword->keyword->id }}" type="submit" class="delete-keyword btn btn-sm btn-block btn-outline-danger">Remove Keyword</button>
								</td>

							</tr>
							@php
							$tempArr[] = $keyword->keyword->id;
							@endphp
							@empty
							@endforelse
						</tbody>
					</table>

					<hr>
						
					<!-- Adding new keword -->
					<form enctype="multipart/form-data" action="{{ route('submission.step3Post',$submission->id) }}" method="post">
						<div class="row my-4 add-keyword-wrap">
							<div class="col-lg-6">
								<div class="form-group">
									<input type="text" class="form-control" id="keyword_text" name="keyword" placeholder="New Keyword">
								</div>
							</div>
							<div class="col-lg-3">								
								<div class="form-group">
									<button type="button" class="sj-btn sj-btnactive add_keyword">Add Keyword</button>
								</div>
							</div>
						</div>
					</form>

					{{--
						<form enctype="multipart/form-data" action="{{ route('submission.step3Post',$submission->id) }}"
						method="post">
						@csrf
						<div class="form-group">
							<label for="keyword">Select Keyword(s)</label>
							<select multiple class="form-control" id="keyword" name="keyword[]">
								<option value="">Select ... </option>
								@foreach ($keywords as $keyword)
								<option @isset($tempArr) @if (in_array($keyword->id, $tempArr))
									selected
									@endif
									@endisset
									data-parent_id="{{ $keyword->parent_id }}" value="{{ $keyword->id }}">
									{{ $keyword->name }}</option>
								@endforeach
							</select>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-outline-primary">Save as
								Draft</button>
							<button type="submit" class="btn btn-primary float-right">Save and Continue</button>
						</div>

					</form>
					--}}

					<div class="form-group">
						<!--<button type="submit" name="draft" class="btn btn-outline-primary">Save as-->
						<!--	Draft</button>-->
						<a type="btn" href={{ route('submission.step2',$submission->id) }}  class="btn btn-primary float-right">Save and Continue</a>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('js')
  <script>
	  $( function() {

	    // add_keyword
	    $(document).on('click', '.add_keyword', function(e) {
	    	e.preventDefault();
	    	var $that = $(this).parents('.add-keyword-wrap');
	    	var keyword_text = $that.find('input#keyword_text').val();

	    	var pageUrl = window.location.pathname;
			pageUrl = pageUrl.split("/");
	
			var submissionId = pageUrl[4];


	    	if(keyword_text==''){
	    		alert('Please type keyword then click add keyword!')
	    	} else {
	    		
				
				console.log('submissionId------------>'+submissionId);
				$.ajax({
					headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					type:"POST",
					url:"./step3-upload",
					dataType: 'json',
					data:{"_token":"{{ csrf_token() }}", "keyword":keyword_text, "submissionId":submissionId},
					
					success:function(data){
						console.log('Inside Success block');
						console.log('data------------->'+JSON.stringify(data));
						console.log('data------------->'+data['status']);
						if(data['status'] != 'duplicateEntry'){
							var serial = parseInt($('.keyword-list-tbody tr.ui-state-default:last-child td:first-child').html());
							if(serial && serial != ''){
								serial = serial+1
								
							} else {
								serial = 1
							}
							$('.keyword-list-tbody').append(`
								<tr class="ui-state-default ui-sortable-handle">
									<td>${serial}</td>
									<td>${keyword_text}</td>
									<td>
										<button data-id="${data.id}" type="button" class="btn btn-sm btn-block btn-outline-danger delete-keyword">
											Remove Keyword
										</button>
									</td>
								</tr>
							`);
							$('.add-keyword-wrap input').val('');
						}else{
							alert('This keyword is assigned before.......!');
						}
					},
					error: function(error){
						// console.log('Inside Error block--------->'+xhr.responseText);
						console.log('Inside Error block--------->'+JSON.stringify(error));
						console.log('Inside Error block--------->'+error['status']);
					}
				});
	    	}
	    });
	    // Delete author
	    $(document).on('click', '.delete-keyword', function (e) {
	    	if(confirm('Are you sure to delete this keyword?')){


				$.post(
					"{{ route('submission.step3DeleteKeyword', $submission->id) }}",
					{
						'_token': $('meta[name=csrf-token]').attr('content'),
						'keyword_id' : $(this).attr('data-id')
					},
					
					function (data, textStatus, jqXHR) {
							
					},
				).done(function() {
					// $(this).parents('tr.ui-state-default').remove(); // kaj kore ne eikhane
				})
				.fail(function() {
				alert( "Not Deleted. Please try again." );
				location.reload();
				});;
				$(this).parents('tr.ui-state-default').remove();
	    	}	    	
	    });

	  } );
  </script>
@endsection