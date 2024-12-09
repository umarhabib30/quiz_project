@extends('layouts.admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h5 class="card-title">{{@$page_title}}</h5>
                </div>
                <div class="card-body">
                    <form class="" method="post" action="{{url('admin/students/edit', $row['id'])}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="{{url('admin/courses')}}">
                        @csrf
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="role" value="3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type='text' name="name" id="name" class="form-control" required=""  value="{{@$row['name']}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Email</label>
                                            <input type='text' name="email" id="email" class="form-control" required="" value="{{@$row['email']}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Password</label>
                                            <input type='password' name="password" id="password" class="form-control" required="" value="{{@$row['password']}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="Male" @if(@$row['gender'] == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if(@$row['gender'] == 'Female') selected @endif>Female</option>
                                                <option value="Other" @if(@$row['gender'] == 'Other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Profile Image</label>
                                            <input type='file' name="image" id="image" class="form-control" value="{{@$row['image']}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Class</label>
                                            <select type='text' name="class_id" id="class_id" class="form-control" required="">
                                                @foreach($Class as $val)
                                                <option value="{{$val->id}}" @if(@$row['class_id'] == $val->id) selected @endif>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Save & Proceed</button>
                        <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).on("keyup", '#course_name', function(event) {
        let val = $(this).val();
        let target = $(this).attr("data-target");
        $(target).val(baseJS.slugify(val));
    });
    document.getElementById("is_feature").addEventListener("change", function () {
        var selectedType = this.value;

        // Hide or disable the Feature Training Type dropdown based on the selected Course Type
        if (selectedType === "Featured training" || selectedType === "All") {
            document.getElementById("featuredOptions").style.display = "block"; // Hide the options
            // OR
            // document.getElementById("feature_type").disabled = true; // Disable the dropdown
        } else {
            document.getElementById("featuredOptions").style.display = "none"; // Show the options
        }

        // Show or hide options based on the selected Course Type
        if (selectedType === "Medical rep training") {
            document.getElementById("medicalRepOptions").style.display = "block";
            document.getElementById("leaderOptions").style.display = "none";
        } else if (selectedType === "Leader training") {
            document.getElementById("medicalRepOptions").style.display = "none";
            document.getElementById("leaderOptions").style.display = "block";
        } else if (selectedType === "Featured training") {
            document.getElementById("medicalRepOptions").style.display = "none";
            document.getElementById("leaderOptions").style.display = "none"; 
        } 
        else {
            // For other course types, show all options
            document.getElementById("medicalRepOptions").style.display = "none";
            document.getElementById("leaderOptions").style.display = "none";
            document.getElementById("featuredOptions").style.display = "none";
        }
    });
</script>
@endsection
{{-- <div class="card-footer">
    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="card">
        Cancel
    </a>
    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="card">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
        Create new report
    </a>
</div> --}}