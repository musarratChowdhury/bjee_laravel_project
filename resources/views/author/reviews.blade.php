@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Reviews for <strong>{{ $submission->title }}</strong></div>
				<div class="card-body">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>Reviewed By</th>
								<th>Rating</th>
								<th>Comments</th>
								<th>Modification files</th>
								<th>Reviewed time</th>
							</tr>
							@foreach ($submission->reviews as $review)
							<tr>
								<td>{{ $review->user->name }}</td>
								<td>{{ $review->rating }}</td>
								<td>{{ $review->comments }}</td>
								<td>{{ $review->file ?? 'No File Given.' }}</td>
								<td>{{ $review->created_at }}</td>
							</tr>
							@endforeach
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
			</div>


		</div>

	</div>
</div>
@endsection