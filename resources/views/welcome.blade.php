@extends('layouts.admin')
@section('content')
<div class="page-body">
  <div class="container-xl">
    <div class="card">
      <div class="row g-0">
        <div class="col d-flex flex-column">
          <div class="card-body">
            <h2 class="mb-4">My Account</h2>
            <h3 class="card-title">Profile Details</h3>
            <form action="{{ url('/admin/profile')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-xl" id="view" style="background-image: url('{{ asset('storage/images/' . Auth::user()->image) }}')">
                    </span>
                </div>
                <div class="col-auto">
                    <input id="image" type="file" name="image" onchange="displayImage(this)">
                </div>
              </div>
              <h3 class="card-title mt-4">User Profile</h3>
              <div class="row g-3">
                <div class="col-md">
                  <div class="form-label">Name</div>
                  <input type="text" class="form-control" name="name"  value="{{Auth::user()->name}}">
                </div>
                <div class="col-md">
                  <div class="form-label">Phone</div>
                  <input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}">
                </div>
                 <div class="col-md">
                  <div class="form-label">Gender</div>
                  <select class="form-control" name="gender" id="gender">
                   <option value="Male">Male</option>
                   <option value="Female">Female</option>
                 </select>
               </div>
              </div>
              <div class="row g-2">
                <div class="col-4">
                  <h3 class="card-title mt-4">Email</h3>
                  <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}" readonly="">
                </div>
               
               <div class="col-8">
                  <h3 class="card-title mt-4">Address</h3>
                  <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                </div>
             </div>
             <h3 class="card-title mt-4">Password</h3>
             <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>

             <div>
              <a href="#" class="btn" id="setNewPasswordBtn">
                Set new password
              </a>
            </div>

            <!-- Password fields initially hidden -->
            <div id="newPasswordFields" style="display: none;">
              <div class="row g-2">
                <div class="col-md">
                  <div class="form-label">New Password</div>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password">
                </div>
                <div class="col-md">
                  <div class="form-label">Confirm Password</div>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="confirm_password" placeholder="Confirm Password">
                </div>
              </div>
            </div>
            <div class="row g-2">
              <h3 class="col-auto card-title mt-4">About Me</h3>
              <textarea class="form-control card-subtitle" name="about_me">{{Auth::user()->about_me}}</textarea>
            </div>
            <div class="row g-2">
              <div class="col-md-6">
                  <div class="form-label">Employer Status</div>
                  <select class="form-control" name="employer_status" id="employer_status">
                   <option value="{{Auth::user()->employer_status}}">{{Auth::user()->employer_status}}</option>
                   <option value="Active">Active</option>
                   <option value="In-active">In-active</option>
                 </select>
               </div>
              <div class="col-md-6">
                  <div class="form-label">Experience Level</div>
                  <select class="form-control" name="exp_level" id="exp_level" value="{{Auth::user()->exp_level}}">
                   <option value="{{Auth::user()->exp_level}}">{{Auth::user()->exp_level}}</option>
                   <option value="Beginner">Beginner</option>
                   <option value="Intermediate">Intermediate</option>
                   <option value="Expert">Expert</option>
                 </select>
               </div>
                <div class="col-md-4">
                  <div class="form-label">Current Employer</div>
                  <input type="current_employer" class="form-control" name="current_employer" placeholder="Enter Current Employer" value="{{Auth::user()->current_employer}}">
               </div>
               <div class="col-md-4">
                  <div class="form-label">Instructor Degree</div>
                  <input type="instructor_degree" class="form-control" name="instructor_degree" placeholder="Instructor Degree" value="{{Auth::user()->instructor_degree}}">
               </div>
               <div class="col-md-4">
                  <div class="form-label">Highest Degree</div>
                  <input type="highest_degree" class="form-control" name="highest_degree" placeholder="Enter Highest Degree" value="{{Auth::user()->highest_degree}}">
               </div>
            </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
              <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                  Update Profile
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('setNewPasswordBtn').addEventListener('click', function () {
        var newPasswordFields = document.getElementById('newPasswordFields');
        newPasswordFields.style.display = newPasswordFields.style.display === 'none' ? 'block' : 'none';
    });

  function displayImage(input) {
        var fileInput = input;
        var view = document.getElementById('view');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                view.style.backgroundImage = 'url(' + e.target.result + ')';
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
@endsection