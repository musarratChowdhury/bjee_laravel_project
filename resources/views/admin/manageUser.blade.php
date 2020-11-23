@extends('layouts.new')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Manage User : {{ $user->name }}</strong>
				</div>
				<div class="card-body">
					<form action="{{ route('admin.manageUserPost', $user->id) }}" method="post">
						@csrf
						<div class="form-group">
							<label for="username">User Name</label>
							<input class="form-control" type="text" name="username" id="username"
								value="{{  $user->name  }}">
						</div>
						<div class="form-group">
							<label for="username">Email</label>
							<input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
						</div>

						@if (in_array('superadmin', $userRoles) === false)							
						<div class="form-group">
							<label for="username">Status</label>
							<div class="custom-control custom-radio">
								<input {{ $user->status === 1 ? 'checked' : '' }} type="radio" id="status1"
									name="status" class="custom-control-input" value="1">
								<label class="custom-control-label" for="status1">Active</label>
							</div>
							<div class="custom-control custom-radio">
								<input {{ $user->status === 0 ? 'checked' : '' }} type="radio" id="status2"
									name="status" class="custom-control-input" value="0">
								<label class="custom-control-label" for="status2">Deactive</label>
							</div>
						</div>
						@endif

						<div class="form-group">
							<label for="password">Set a Password</label>
							<input class="form-control" type="text" name="password" id="password">
						</div>



						<div class="form-group">
							<label for="username">Set Role(s)</label>
							<select {{ in_array('superadmin', $userRoles) === true ? 'disabled' : '' }} multiple class="form-control select2" id="userrole" name="userrole[]"
								style="width: 100%">
								<option value="">Select ... </option>
								@foreach ($roles as $role)
								@continue($role->name === 'superadmin')
								<option {{ in_array($role->name, $userRoles) === true ? 'selected' : '' }} value="{{ $role->name }}">
									{{ $role->name }}
								</option>
								@endforeach								
								{!! in_array('superadmin', $userRoles) == true ? '<option selected value="superadmin">superadmin</option>' : '' !!} 
							</select>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>								
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


@section('js')
<script>
	// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#userrole').select2();
    });
</script>
{{-- <div class="form-group">
							<label for="userrole">Set user Role</label>
							
							<select aaclass="form-control" id="userrole" name="userrole">
								<option value="">Select ... </option>
								@foreach ($roles as $role)
								<option value="{{ $role->id }}">{{ $role->name }}</option>
@endforeach
</select>
</div> --}}	
{{-- @foreach ($roles as $role)
							@continue($role->name === 'superadmin')
							<div class="form-group">
								<label for="username">Role: {{ strtoupper($role->name) }}</label>
<div class="custom-control custom-checkbox">
	<input type="checkbox" name="{{ $role->name }}" class="custom-control-input" id="{{ $role->name }}">
	<label class="custom-control-label" for="{{ $role->name }}">Check to make user a {{strtoupper($role->name)}}</label>
</div>
<div class="custom-control custom-radio">
	<input type="radio" id="{{ $role->name }}1" name="{{ $role->name }}" class="custom-control-input" value="1">
	<label class="custom-control-label" for="{{ $role->name }}1">Yes</label>
</div>
<div class="custom-control custom-radio">
	<input type="radio" id="{{ $role->name }}2" name="{{ $role->name }}" class="custom-control-input" value="0">
	<label class="custom-control-label" for="{{ $role->name }}2">No</label>
</div>
</div>
@endforeach --}}
@endsection