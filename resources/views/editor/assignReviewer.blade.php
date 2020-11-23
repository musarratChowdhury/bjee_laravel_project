@extends('layouts.new')

@section('content')
<style>
#reviewerList ul {
    width: 100%;
    padding: 0;
}

#reviewerList ul li {
    list-style: none;
    cursor: pointer;
    padding: 5px 20px;
    border-top: 1px solid #ddd;
}
#reviewerList ul li:first-child {
    border-top: none;
}

#reviewerList ul li:hover,
#reviewerList ul li:focus {
    background: #ddd;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Assign Reviewers for Submissions</b>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Assign New Reviewer</button>
					<a class="float-right btn btn-sm btn-outline-dark" href="{{ route('editor.addNewReviewer') }}">Add
						New Reviewer</a>
				</div>
				<div class="card-body">

                    @if ($all_current_reviewer_count > 0)
					<h3>Reviewers Assigned</h3>

					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>Review No</th>
								<th>Name</th>
								<th>Last Review Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($all_current_reviewer as $key=>$reviewer)
							<tr>

								<!--<td>{{ $reviewer->user->id }}</td>-->
								<td>{{ ++$key }}</td>
								<td>{{ $reviewer->user->name ?? ' - ' }}</td>
								<td>{{ $reviewer->review_last_date ?? ' - ' }}</td>
								<td>
								    
								    @if($reviewer->accepted === 1)
								    Review has accepted to review.
								    @endif
								    
									
									@if($reviewer->accepted === 0)
								    Reviewer has rejected to review.
								    @endif
								    
								    
								    @if($reviewer->accepted === NULL)
								    Review has not reponded yet
								    @endif
								    
								    
								
									
								</td>
							</tr>
							@empty
                                <tr>
                                    <td colspan="3">
                                        No Reviewer Assigned yet.
                                    </td>
                                </tr>
							@endforelse
						</tbody>
					</table>
					<hr>
                    @endif
					<!--<h3>Assign Reviewers for <strong>{{ $submission->title }}</strong> Submission</h3>-->
					<!--<form method="POST" action="{{ route('editor.assignReviewerPost', $submission->id) }}">-->
					<!--	@csrf-->
					<!--	@foreach ($reviewers as $reviewer)-->

					<!--	<div class="form-group">-->
					<!--		@if (in_array($reviewer->id, $current_reviewer))-->

					<!--		<div class="custom-control custom-checkbox">-->
					<!--			<input disabled checked type="checkbox" class="custom-control-input"-->
					<!--				id="reviewer[{{ $reviewer->id }}]">-->
					<!--			<label class="custom-control-label" for="reviewer[{{ $reviewer->id }}]">-->
					<!--				{{ $reviewer->name }} --->
					<!--				@if ($current_reviewer_status[$reviewer->id]->accepted === null )-->
					<!--				not reponded yet.-->
					<!--				@endif-->
					<!--				@if ($current_reviewer_status[$reviewer->id]->accepted === 1 )-->
					<!--				accepted.-->

					<!--				@endif-->
					<!--				@if ($current_reviewer_status[$reviewer->id]->accepted === 0 )-->
					<!--				rejected.-->
					<!--				@endif-->
					<!--			</label>-->
					<!--		</div>-->

					<!--		@else-->

					<!--		<div class="custom-control custom-checkbox">-->
					<!--			<input type="checkbox" class="custom-control-input"-->
					<!--				id="reviewer[{{ $reviewer->id }}]['id']"-->
					<!--				name="reviewer[{{ $reviewer->id }}][selected]">-->
					<!--			<label class="custom-control-label" for="reviewer[{{ $reviewer->id }}]['id']">-->
					<!--				{{  $reviewer->name }}-->
					<!--			</label>-->
					<!--			<label class="label" for="reviewer[{{ $reviewer->id }}]['date']">-->
					<!--				Set last day to review-->
					<!--				<input value="{!! $defaultDate  !!}" class="" type="date"-->
					<!--					name="reviewer[{{ $reviewer->id }}][date]"-->
					<!--					id="reviewer[{{ $reviewer->id }}]['date']">-->
					<!--			</label>-->
					<!--		</div>-->

					<!--		@endif-->

					<!--	</div>-->
					<!--	@endforeach-->
					<!--	<div class="form-group">-->
					<!--		<button type="submit" class="btn btn-primary">Assign Selected Reviewers</button>-->
					<!--	</div>-->
					<!--</form>-->

				</div>

			</div>
		</div>

	</div>

    <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-md">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Assign Selected Reviewers</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
			    <div class="col-lg-12">
    				<div class="form-group">
    					<label for="usr">Name:</label>
    					<input type="text" class="form-control" id="reviewerInput">
    					<div id="reviewerList">
    
    					</div>
    				</div>
    				
                    <form method="POST" action="{{ url('editor/assign-reviewer-with-mail') }}">
                        @csrf
                        <input type="hidden" name="reviewer_id" id="reviewer_id">
                        <input type="hidden" name="submission_id" value="{{$submission->id}}">
                        
                        <div class="form-group">
                            <input value="{!! $defaultDate  !!}" class="form-control" type="date" name="review_last_date">
        				</div>
        				
        				<div class="form-group text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign Selected Reviewers</button>
        				</div>
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
	$(document).ready(function() {
		$('#reviewerInput').on('keyup',function() {
			var reviewerName = $(this).val();
			// console.log(reviewerName);
			if(reviewerName != ''){
				$.ajax({
					type:'POST',
					url:'./ajax_assReviewer_autocomplete',
					data:{"_token":"{{ csrf_token() }}", "reviewerName":reviewerName},
					
					success:function(data){
						if(data =='' || data==null){

						}else{
							$('#reviewerList').fadeIn();
							$('#reviewerList').html(data)
						}
					}
				});
			}else{
				$('#reviewerList').fadeOut();
			}
		});
		$(document).on('click','.reviewerList',function(){
			var emailName = $(this).text();
			var reviewerId = $(this).data('id');

			console.log(reviewerId);
			$('#reviewerInput').val(emailName);
			$('#reviewer_id').val(reviewerId);
			$('#reviewerList').fadeOut();
			console.log(emailName);
		});
	});
</script>
@endsection