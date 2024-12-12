@extends('layouts.student')
@section('content')
<style type="text/css">
	.card-body .dropdown-menu.dropdown-menu-end.show{
		right: 200px !important;
		bottom: 10px !important
	}
	.relative {
		color: #182433 !important;
	}
	@media(max-width: 575px) {
		.dropdown-menu.dropdown-menu-end.show{
			right: 0px !important;
		}
	}
</style>

<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col card mt-3">
				<div class="card-header">
					<h2 class="page-title">Quiz Assigned
					</h2>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-vcenter table-mobile-md card-table">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Date (YYYY-MM-DD)</th>
									<th>Time (HH:MM)</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if(count($quizzes) > 0)
								@foreach($quizzes as $key => $quiz)
								<tr class="list_{{ $quiz->id }}">
									<th scope="row">{{ $key + 1 }}</th>
									<td class="pl-0" data-id="{{ $quiz->id }}">{{ $quiz->title }}</td>
									<td class="pl-0">
										{{ \Carbon\Carbon::parse($quiz->start_date)->format('Y-m-d') }}
									</td>
									<td class="pl-0">
										{{ \Carbon\Carbon::parse($quiz->start_time)->format('H:i') }}
									</td>
									<td>

										<a class="btn btn-success" href="{{ url('student/start-quiz/' . $quiz->id) }}">Start Quiz</a>
										
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="5">No quizzes available for your class today.</td>
								</tr>
								@endif


							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<!-- <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="disclaimerModalLabel">Disclaimer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Please read and accept the disclaimer before proceeding to use this dashboard.</p>
			</div>
			<div class="modal-footer">
				<button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-primary">I Accept</button>
			</div>
		</div>
	</div>
</div>
 -->
<!-- Include Bootstrap JS -->
<!-- <script>
	document.addEventListener("DOMContentLoaded", function () {
        // Automatically show the modal when the page loads
		const disclaimerModal = new bootstrap.Modal(document.getElementById('disclaimerModal'));
		disclaimerModal.show();

        // Add click event listener to the "I Accept" button
		document.getElementById('acceptButton').addEventListener('click', function () {
            // Hide the modal
			disclaimerModal.hide();

            // Redirect to the desired URL
			window.location.href = "{{ url('student/quiz') }}";
		});
	});
</script> -->

@endsection