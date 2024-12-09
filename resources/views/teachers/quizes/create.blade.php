@extends('layouts.admin')

@section('content')
<div class="page-header d-print-none mb-5">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h5 class="card-title">{{@$page_title}}</h5>
                </div>
                <div class="modal-body">
                    <form class="" method="post" action="{{url('teacher/quiz/create')}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
                        @csrf
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type='text' name="title" id="title" class="form-control" required=""  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Class</label>
                                            <select name="class_id" id="class_id" class="form-control" required="">
                                                @foreach($Class as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Start Time</label>
                                            <input type="time" name="start_time" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block mr-2">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
