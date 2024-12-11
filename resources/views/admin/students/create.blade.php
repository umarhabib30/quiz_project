@extends('layouts.admin')
@section('content')
<div class="page-header d-print-none mb-5">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="modal-body">
                <form class="" method="post" action="{{url('admin/students/create')}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
                    @csrf
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="role" value="3">
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type='text' name="name" id="name" class="form-control" required=""  />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Email</label>
                                        <input type='text' name="email" id="email" class="form-control" required="" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Password</label>
                                        <input type='password' name="password" id="password" class="form-control" required="" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Profile Image</label>
                                        <input type='file' name="image" id="image" class="form-control" />
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Class</label>
                                        <select name="class_id" id="class_id" class="form-control" required="">
                                            @foreach($Class as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
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
@endsection
