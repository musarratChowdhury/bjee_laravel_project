<ul>
	

	@auth
	@role('author')
	<li class="menu-item-has-children page_item_has_children">
		<a href="javascript:void(0);">Author Dashboard</a>
		<ul class="sub-menu">
			<li><a href="{{ route('author') }}">Previous Submission</a></li>
			<li><a href="{{ route('startSubmission') }}">Create Submission</a></li>
		</ul>
	</li>
	@endrole

	@role('editor')
	<li class="menu-item-has-children page_item_has_children">
		<a href="javascript:void(0);">Editor Dashboard</a>
		<ul class="sub-menu">
			<li><a href="{{ route('editor.submissions') }}">Submissions</a></li>
			<li><a href="{{ route('editor.reviewers') }}">Manage Reviewer</a></li>
			<li><a href="{{ route('editor.journals') }}">Manage Journal</a></li>
		</ul>
	</li>
	@endrole

	@role('reviewer')
	<li class="menu-item-has-children page_item_has_children">
		<a href="javascript:void(0);">Reviewer Dashboard</a>
		<ul class="sub-menu">
			<li><a href="{{ route('reviewer.submissions') }}">Submissions To Review</a></li>
		</ul>
	</li>	
	@endrole

	@role('superadmin')
	<li class="menu-item-has-children page_item_has_children">
		<a href="javascript:void(0);">Admin Dashboard</a>
		<ul class="sub-menu">
			<li><a href="{{ route('editor.submissions') }}">Submissions</a></li>
			<li><a href="{{ route('admin.users') }}">Manage Users</a></li>
		</ul>
	</li>
	@endrole

	@else

	<li class="menu-item-has-children page_item_has_children v-hidden">
		<span class="sj-tagnew">New</span>
		<a href="javascript:void(0);">Issues</a>
		<ul class="sub-menu">
			<li><a href="#">Issues Weeks</a></li>
			<li><a href="#">Issues Years</a></li>
		</ul>
	</li>

	@endauth


	{{-- <li>
		<a href="#">About us</a>
	</li> --}}

</ul>