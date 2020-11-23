<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header"></div>
					<div class="card-body">
						<h1>Details</h1>
						<div class="table-responsive-sm">
							<table style="width: 100%" class="table" border="1" cellpadding="10" cellspacing="0">
								<tbody>
									<tr>
										<td scope="row">Title : {{ $submission->title }}</td>
									</tr>
									<tr>
										<td scope="row">Type : {{ $submission->submissionType->name ?? '-' }}</td>
									</tr>
									<tr>
										<td scope="row">Submission Date : {{ $submission->created_at ?? '-' }}</td>
									</tr>
								</tbody>
							</table>
							<hr>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>

</html>