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
            <form action="{{ url('/user/profile')}}" method="post" enctype="multipart/form-data">
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
                    <option>Select Gender</option>
                   <option value="Male" @if(Auth::user()->gender == 'Male') selected @endif>Male</option>
                   <option value="Female" @if(Auth::user()->gender == 'Female') selected @endif>Female</option>
                   <option value="Other" @if(Auth::user()->gender == 'Other') selected @endif>Other</option>
                 </select>
               </div>
             </div>
             <div class="row g-2">
              <div class="col-4">
                <h3 class="card-title mt-4">Email</h3>
                <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}" readonly="">
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