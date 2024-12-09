@extends('layouts.admin')

@section('content')
@if(Auth::user()->role != '3')
<div class="page-body">
  <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Students</div>
              <div class="ms-auto lh-1"></div>
            </div>
            <div class="h1 mb-3">{{ @$students }}</div>
            <div class="progress progress-sm">
              <div 
              class="progress-bar bg-blue" 
              style="width: {{ min(max(@$students, 0), 100) }}%;" 
              role="progressbar" 
              aria-valuenow="{{ min(max(@$students, 0), 100) }}" 
              aria-valuemin="0" 
              aria-valuemax="100">
              <span class="visually-hidden">{{ @$students }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Teachers</div>
            <div class="ms-auto lh-1"></div>
          </div>
          <div class="h1 mb-3">{{ @$teachers }}</div>
          <div class="progress progress-sm">
            <div 
            class="progress-bar bg-blue" 
            style="width: {{ min(max(@$teachers, 0), 100) }}%;" 
            role="progressbar" 
            aria-valuenow="{{ min(max(@$teachers, 0), 100) }}" 
            aria-valuemin="0" 
            aria-valuemax="100">
            <span class="visually-hidden">{{ @$teachers }}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Classes</div>
          <div class="ms-auto lh-1"></div>
        </div>
        <div class="h1 mb-3">{{ @$classes }}</div>
        <div class="progress progress-sm">
          <div 
          class="progress-bar bg-blue" 
          style="width: {{ min(max(@$classes, 0), 100) }}%;" 
          role="progressbar" 
          aria-valuenow="{{ min(max(@$classes, 0), 100) }}" 
          aria-valuemin="0" 
          aria-valuemax="100">
          <span class="visually-hidden">{{ @$classes }}%</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-6 col-lg-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div class="subheader">Quiz</div>
        <div class="ms-auto lh-1"></div>
      </div>
      <div class="h1 mb-3">{{ @$quiz }}</div>
      <div class="progress progress-sm">
        <div 
        class="progress-bar bg-blue" 
        style="width: {{ min(max(@$quiz, 0), 100) }}%;" 
        role="progressbar" 
        aria-valuenow="{{ min(max(@$quiz, 0), 100) }}" 
        aria-valuemin="0" 
        aria-valuemax="100">
        <span class="visually-hidden">{{ @$quiz }}%</span>
      </div>
    </div>
  </div>
</div>
</div>


</div>
</div>
</div>
@else
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
              @php 
              $class = \App\Models\Classes::where('id', Auth::user()->class_id)->first();
              @endphp
              <div class="col-4">
                <h3 class="card-title mt-4">Class</h3>
                <input type="text" name="Class" class="form-control" value="{{ $class ? $class->name : 'N/A' }}" readonly>
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
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
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
@endif
@endsection
