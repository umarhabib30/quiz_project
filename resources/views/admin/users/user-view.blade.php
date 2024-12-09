@extends('layouts.admin')

<title>User</title>

@section('content')

<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">
					User
				</h2>
			</div>
		</div>
	</div>
</div>

<div class="page-body container">
	<div class="col-12">
		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter table-mobile-md card-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th class="w-1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($user as $key => $val)
						<tr>
							<td data-label="Name">
								{{ ++$key }}
							</td>
							<td data-label="Name">
								{{ $val->name }}
							</td>
							<td data-label="Title">
								{{ $val->email }}
							</td>
							<td>
								<div class="btn-list flex-nowrap">
									<div class="dropdown">
										<button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</button>
										<div class="dropdown-menu dropdown-menu-end" style="">
											<a class="dropdown-item" href="#">
												Action
											</a>
											<a class="dropdown-item" href="#">
												Another action
											</a>
										</div>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection