@extends('layouts.student')
@section('content')
<style type="text/css">
	/* Modal Styling */
	#video-modal {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 50%;
		height: 50%;
		max-width: 600px;
		background-color: #fff;
		border: 1px solid #ddd;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		padding: 20px;
		z-index: 1000;
		text-align: center;
		border-radius: 10px;
		overflow: hidden; /* Ensures the modal's content doesn't overflow */
	}

	#video-modal video {
		width: 100%;
		height: calc(100% - 80px); /* Adjusted to accommodate buttons below the video */
		border-radius: 5px;
		margin-bottom: 10px;
	}

	#video-modal div {
		display: flex;
		justify-content: space-between;
	}

	#video-modal div button {
		flex: 1; /* Makes buttons evenly spaced */
		margin: 0 5px;
	}

	/* Overlay */
	#modal-overlay {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		z-index: 999;
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
									<th>Question</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if(isset($questions) && $questions->count() > 0)
								@foreach($questions as $key => $val)
								<tr class="question-row list_{{ $val->id }}" data-question-id="{{ $val->id }}" style="display: {{ $key === 0 ? 'table-row' : 'none' }};">
									<th scope="row">{{ $key + 1 }}</th>
									<td class="pl-0" data-id="{{ $val->id }}">{{ $val->question }}</td>
									<td>
										<form id="submit-answer-form-{{ $val->id }}" action="{{ url('student/submit-answer/' . $val->quiz_id .'/' . $val->id) }}" method="POST" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="question_id" value="{{ $val->id }}">
											<input type="hidden" name="quiz_id" value="{{ $val->quiz_id }}">
											<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
											<input type="hidden" name="video" id="video-input-{{ $val->id }}" value="">
											<button type="button" class="btn btn-success submit-answer-btn" data-question-id="{{ $val->id }}">Submit Answer</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="3">No questions available for this quiz.</td>
								</tr>
								@endif
							</tbody>

							<!-- Webcam and Video Preview Modal -->
							<div id="modal-overlay"></div>
							<div id="video-modal">
								<video id="preview-video" controls autoplay muted></video>
								<div>
									<button id="re-record-btn" class="btn btn-warning">Re-record Video</button>
									<button id="confirm-btn" class="btn btn-primary" disabled>Confirm Video</button>
								</div>
								<p id="tries-left"></p>
							</div>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// document.addEventListener('DOMContentLoaded', () => {
	// 	const modal = document.getElementById('video-modal');
	// 	const overlay = document.getElementById('modal-overlay');
	// 	const questionRows = document.querySelectorAll('.question-row');
	// 	const totalQuestions = questionRows.length;
	// 	let mediaRecorder, recordedChunks = [];
	// 	let tries = 3;

	// 	const openModal = () => {
	// 		modal.style.display = 'block';
	// 		overlay.style.display = 'block';
	// 	};

	// 	const closeModal = () => {
	// 		modal.style.display = 'none';
	// 		overlay.style.display = 'none';
	// 	};

	// 	questionRows.forEach((row, index) => {
	// 		const submitBtn = row.querySelector('.submit-answer-btn');
	// 		submitBtn.addEventListener('click', () => handleRecording(row, index));
	// 	});

	// 	const handleRecording = (row, index) => {
	// 		if (tries <= 0) {
	// 			alert('You have exceeded the maximum recording attempts.');
	// 			return;
	// 		}

	// 		navigator.mediaDevices.getUserMedia({ video: true, audio: true })
	// 		.then(stream => {
	// 			const videoElement = document.getElementById('preview-video');
	// 			videoElement.srcObject = stream;

	// 			mediaRecorder = new MediaRecorder(stream);
	// 			recordedChunks = [];

	// 			mediaRecorder.ondataavailable = event => recordedChunks.push(event.data);
	// 			mediaRecorder.onstop = () => {
	// 				const blob = new Blob(recordedChunks, { type: 'video/webm' });
	// 				const videoURL = URL.createObjectURL(blob);

    //                 // Show Preview
	// 				videoElement.srcObject = null;
	// 				videoElement.src = videoURL;

    //                 // Enable Confirm Button
	// 				document.getElementById('confirm-btn').disabled = false;

    //                 // Save blob data as a base64 string to the form input
	// 				const reader = new FileReader();
	// 				reader.onload = () => {
	// 					const videoInput = row.querySelector(`#video-input-${row.dataset.questionId}`);
    //                     videoInput.value = reader.result; // Base64 string
    //                 };
    //                 reader.readAsDataURL(blob);
    //             };

    //             mediaRecorder.start();

    //             // Stop recording after 30 seconds
    //             setTimeout(() => {
    //             	mediaRecorder.stop();
    //             	stream.getTracks().forEach(track => track.stop());
    //             }, 30000);

    //             openModal();
    //             document.getElementById('tries-left').innerText = `You have ${tries} tries left.`;
    //         })
	// 		.catch(error => {
	// 			console.error('Error accessing webcam:', error);
	// 			alert('Could not access the webcam. Please ensure it is connected and permissions are granted.');
	// 		});
	// 	};

    // // Re-record Button
	// 	document.getElementById('re-record-btn').addEventListener('click', () => {
	// 		if (tries > 1) {
	// 			tries--;
	// 			document.getElementById('tries-left').innerText = `You have ${tries} tries left.`;
	// 			document.getElementById('confirm-btn').disabled = true;
    //         handleRecording(questionRows[0], 0); // Re-initiate recording for the current row
    //     } else {
    //     	alert('You have no more attempts left.');
    //     }
    // });

    // // Confirm Button
	// 	document.getElementById('confirm-btn').addEventListener('click', () => {
	// 		const currentRow = Array.from(questionRows).find(row => row.style.display === 'table-row');
	// 		const form = currentRow.querySelector(`#submit-answer-form-${currentRow.dataset.questionId}`);

	// 		if (form) {
	// 			closeModal();

    //         // Trigger form submission
	// 			form.submit();
	// 		}
	// 	});

    // // Close modal on overlay click
	// 	overlay.addEventListener('click', closeModal);
	// });


	document.addEventListener('DOMContentLoaded', () => {
		const modal = document.getElementById('video-modal');
		const overlay = document.getElementById('modal-overlay');
		const questionRows = document.querySelectorAll('.question-row');
        const beepAudio = new Audio("{{asset('assets/beep.mp3')}}"); // Add path to the beep sound file
        const totalQuestions = questionRows.length;
        let mediaRecorder, recordedChunks = [];
        let tries = 3;

        const openModal = () => {
        	modal.style.display = 'block';
        	overlay.style.display = 'block';
        };

        const closeModal = () => {
        	modal.style.display = 'none';
        	overlay.style.display = 'none';
        };

        const speakText = (text) => {
        	const speech = new SpeechSynthesisUtterance(text);
        	speechSynthesis.speak(speech);
        };

        const handleRecording = (row, index) => {
        	if (tries <= 0) {
        		alert('You have exceeded the maximum recording attempts.');
        		return;
        	}

            // Play beep sound and speak the question
        	beepAudio.play();
        	beepAudio.onended = () => {
        		speakText(row.querySelector('td').textContent);

        		navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        		.then(stream => {
        			const videoElement = document.getElementById('preview-video');
        			videoElement.srcObject = stream;

        			mediaRecorder = new MediaRecorder(stream);
        			recordedChunks = [];

        			mediaRecorder.ondataavailable = event => recordedChunks.push(event.data);
        			mediaRecorder.onstop = () => {
        				const blob = new Blob(recordedChunks, { type: 'video/webm' });
        				const videoURL = URL.createObjectURL(blob);

                            // Show Preview
        				videoElement.srcObject = null;
        				videoElement.src = videoURL;

                            // Enable Confirm Button
        				document.getElementById('confirm-btn').disabled = false;

                            // Save blob data as a base64 string to the form input
        				const reader = new FileReader();
        				reader.onload = () => {
        					const videoInput = row.querySelector(`#video-input-${row.dataset.questionId}`);
                                videoInput.value = reader.result; // Base64 string
                            };
                            reader.readAsDataURL(blob);
                        };

                        mediaRecorder.start();

                        // Stop recording after 30 seconds
                        setTimeout(() => {
                        	mediaRecorder.stop();
                        	stream.getTracks().forEach(track => track.stop());
                        }, 30000);

                        openModal();
                        document.getElementById('tries-left').innerText = `You have ${tries} tries left.`;
                    })
        		.catch(error => {
        			console.error('Error accessing webcam:', error);
        			alert('Could not access the webcam. Please ensure it is connected and permissions are granted.');
        		});
        	};
        };

        // Initial action for the first question
        handleRecording(questionRows[0], 0);

        // Re-record Button
        document.getElementById('re-record-btn').addEventListener('click', () => {
        	if (tries > 1) {
        		tries--;
        		document.getElementById('tries-left').innerText = `You have ${tries} tries left.`;
        		document.getElementById('confirm-btn').disabled = true;
                handleRecording(questionRows[0], 0); // Re-initiate recording for the current row
            } else {
            	alert('You have no more attempts left.');
            }
        });

        // Confirm Button
        document.getElementById('confirm-btn').addEventListener('click', () => {
        	const currentRow = Array.from(questionRows).find(row => row.style.display === 'table-row');
        	const form = currentRow.querySelector(`#submit-answer-form-${currentRow.dataset.questionId}`);

        	if (form) {
        		closeModal();

                // Trigger form submission
        		form.submit();
        	}
        });

        // Close modal on overlay click
        overlay.addEventListener('click', closeModal);
    });
</script>
@endsection