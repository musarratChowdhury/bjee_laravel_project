@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Start Submissions</div>
				<div class="card-body">
					<div class="list-group">
						<a href="{{ route('author') }}" class="list-group-item list-group-item-action">Manuscripts in
							Draft</a>
						<a href="{{ route('startSubmission') }}"
							class="list-group-item list-group-item-action active">New Submission</a>
					</div>
				</div>
			</div>


		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Start New Submission
				</div>
				<div class="card-body">
					<p class="card-text">Submission allows you to upload files that were created from many
						sources.</p>

					<form enctype="multipart/form-data" action="{{ route('createSubmission') }}" method="POST">
						@csrf
						{{-- <div class="form-group">
							<input name="title" type="text" class="form-control" placeholder="Give a Title (Required)" required>
						</div> --}}
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Begin New Submission</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection