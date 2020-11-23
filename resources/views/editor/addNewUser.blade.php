@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Add New Reviewer</strong>
				</div>
				<div class="card-body">
					<form action="{{ route('editor.saveNewReviewer') }}" method="post">
						@csrf
						<div class="form-group">
							<label for="username">User Name</label>
							<input class="form-control" type="text" name="username" id="username">
						</div>
						<div class="form-group">
							<label for="username">Email</label>
							<input class="form-control" type="email" name="email" id="email">
						</div>
						<div class="form-group">
							<label for="password">Set a Password</label>
							<input class="form-control" type="text" name="password" id="password">
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit Your Review</button>
						</div>
					</form>
				</div>
				<div class="card-footer">

				</div>
			</div>


		</div>

	</div>
</div>
@endsection