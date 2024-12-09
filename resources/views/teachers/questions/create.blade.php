@extends('layouts.admin')
@section('content')
<div class="container modal-body mt-5 mb-5">
    <a href="{{ url('teacher/questions/' . $quizid)}}" class="mt-5 mb-5 btn btn-outline-primary btn-block">Back</a>
    <form 
    method="post" 
    action="{{ url('teacher/questions/' . $quizid . '/create') }}" 
    enctype="multipart/form-data" 
    data-action="make_ajax_file" 
    data-action-after="reload"
    >
    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input 
            type="text" 
            name="question" 
            id="question" 
            class="form-control" 
            placeholder="Enter your question here" 
            required 
            />
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success btn-block">Create</button>
    </div>
</form>

</div>
<script type="text/javascript">
    $(document).on('submit', 'form', function (e) {
    e.preventDefault();

    var form = $(this);
    var action = form.attr('action');
    var formData = new FormData(this);

    $.ajax({
        url: action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.flag) {
                alert(response.msg);
                if (response.redirect) {
                    window.location.href = response.redirect; // Redirect to the index route
                }
            } else {
                alert(response.msg);
            }
        },
        error: function (xhr) {
            alert('Something went wrong. Please try again.');
        }
    });
});


</script>
@endsection
