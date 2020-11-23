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
							class="list-group-item list-group-item-action active">Step 4: Authors & Institutions</a>
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
				<div class="card-header">Step 4: Authors & Institutions</div>
				<div class="card-body">
					<!--<p class="card-text">-->
					<!--	Enter your co-authors' information in the boxes below, then click "Add to My Authors." To check-->
					<!--	if an author already exists in the journal's database, enter the author's e-mail address and-->
					<!--	click "Find." If the author is found, their information will be automatically filled out for-->
					<!--	you. When you are finished, click "Save and Continue." Note: Author information will not be-->
					<!--	included in materials sent out for review; SNR honors a blind peer review process.-->
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

					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Order</th>
								<th scope="col">Author</th>
								<th scope="col">Institution</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody id="sortable" class="author-list-tbody">
							
							@php
								$key = 1;
							@endphp
							@foreach ($authors as $author)
							<tr class="ui-state-default">
								<td>{{ $key++ }}</td>
								<td>{{ $author->name ?? '' }} ({{ $author->email ?? '' }})</td>
								<td>{{ $author->institution ?? '-' }}</td>
								<td>								
								<button data-id="{{$author->id }}" type="submit" class="btn btn-sm btn-block btn-outline-danger delete-author">
										Delete Author
									</button>
								</td>
							</tr>

							@endforeach

						</tbody>
					</table>
					<hr>

					<form action="#" enctype="multipart/form-data">						
						<div class="row my-4 add-author-wrap">
							<div class="col-lg-3">
								<div class="form-group">
									<input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<input type="email" class="form-control" id="author_email" name="author_email" placeholder="Author Email">
								</div>
							</div>
							<div class="col-lg-3">								
								<div class="form-group">
									<input type="text" class="form-control" id="author_institute" name="author_institute" placeholder="Institute">
								</div>
							</div>
							<div class="col-lg-3">								
								<div class="form-group">
									<button type="submit" class="sj-btn sj-btnactive add_author">Add Author</button>
								</div>
							</div>
						</div>	

						<!--<div class="form-group">-->
						<!--	<button type="submit" class="btn btn-outline-primary">Save as Draft</button>-->
						<!--	<button type="submit" class="btn btn-primary float-right">Save and Continue</button>-->
						<!--</div>-->
						<div class="form-group">
							<!--<button type="submit" name="draft" class="btn btn-outline-primary">Save as-->
							<!--	Draft</button>-->
							<a type="btn" href="{{ route('submission.step5',$submission->id) }}" class="btn btn-primary float-right">Save and Continue</a>
						</div>

					</form>

				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('js')
  <script>
	  $( function() {
	      
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
               return false;
            }else{
               return true;
            }
         }

	    // add_author
	    $(document).on('click', '.add_author', function(e) {
	    	e.preventDefault();
	    	var $that = $(this).parents('.add-author-wrap');
	    	var name = $that.find('input#author_name').val();
	    	var email = $that.find('input#author_email').val();
	    	var institute = $that.find('input#author_institute').val();
	    	
	    	if( !name || !email || !IsEmail(email) ){
	    		alert('Please type author name, email and then click add author!')
	    	} else {
				$.ajax({
					type: "post",
					url: "{{ route('submission.step4Post', $submission->id) }}",
					dataType: "json",
					data: {
						name: name,
						email: email,
						institution: institute,
						'_token': $('meta[name=csrf-token]').attr('content'),
					},
					dataType: "dataType",
					success: function (data) {
						console.log(data);	
					},
					error: function() {
						
					}
				});
				
		         var serial = parseInt($('.author-list-tbody tr.ui-state-default:last-child td:first-child').html());
				 if(serial && serial != ''){
				    serial = serial+1
				     
				 } else {
				     serial = 1
				 }
				$('.author-list-tbody').append(`
						<tr class="ui-state-default">
							<td>${serial}</td>
							<td>${name} (${email})</td>
							<td>${institute}</td>
							<td>
								<button type="submit" class="btn btn-sm btn-block btn-outline-danger delete-author">
								Delete Author
								</button>
							</td>
						</tr>
						`);
				$('.add-author-wrap input').val('');
	    		
	    	} 
	    });
	    // Delete author
	    $(document).on('click', '.delete-author', function () {
	    	if(confirm('Are you sure to delete this author?')){
	    		$(this).parents('tr.ui-state-default').remove();
				$.post(
					"{{ route('submission.step4AuthorDelete', $submission->id) }}",
					{
						'_token': $('meta[name=csrf-token]').attr('content'),
						'author_id' : $(this).attr('data-id')
					},					
					function (data, textStatus, jqXHR) {
							
					},"json"
				).done(function() {
					// $(this).parents('tr.ui-state-default').remove(); // kaj kore ne eikhane
				})
				
	    	}	    	
	    });

	  } );
  </script>
@endsection