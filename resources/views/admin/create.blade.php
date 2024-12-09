@extends('layouts.admin')

<title>Admin Dashboard</title>

@section('content')
<div class="container modal-body">
    <form class="" method="post" action="{{url('/instructor/dashboard/create')}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mb-3">
                        <label for="date" class="form-label">Select Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" required="" id="date">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                        <input type="time" name="end_time" id="end_time" class="form-control" required="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Create</button>
            <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
        </div>
    </form>
</div>
@endsection