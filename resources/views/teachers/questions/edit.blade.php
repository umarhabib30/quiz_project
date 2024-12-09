@extends('layouts.admin')
@section('content')
<div class="page-header d-print-none mb-5">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-body">
            <a href="{{ url('teacher/questions/' . $quizid)}}" class="mt-5 mb-5 btn btn-outline-primary btn-block">Back</a>
                    <form method="post" action="{{ url('teacher/questions/' . $quizid . '/edit/' . $row['id']) }}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="{{ url('teacher/questions') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question</label>
                                        <input type="text" name="question" class="form-control" required value="{{ @$row['question'] }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Save & Proceed</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
