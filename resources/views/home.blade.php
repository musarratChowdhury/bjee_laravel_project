@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					Hi {{ Auth::user()->name }}; you are logged in as @foreach (Auth::user()->getRoleNames() as $role)
					{{ $role }}
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection