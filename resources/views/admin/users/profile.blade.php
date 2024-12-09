@extends('layouts.admin')
@section('content')
<style>
		.profile-form{
			border-radius: 10px;
			box-shadow:  20px 20px 60px #bebebe,
             -20px -20px 60px #ffffff;
		}	
</style>
<div class="container">
    <form method="post" action="{{ url('/admin/profile')}}" enctype="multipart/form-data" class="profile-form border p-3" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="form-row border-bottom">
            <div class="form-group col-md-12">
                <h2>Profile</h2>
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col-md-12 d-flex">
                <div class="avatar avatar-xl form-control" id="view" style="background-image: url('{{ asset('storage/images/' . Auth::user()->profile) }}'); background-size: cover; background-position: center; height: 150px; width: 20%; display: flex;">
                </div>
                	<div class="form-group m-5">
                <input id="profile" class="form-control" type="file" name="profile" onchange="displayImage(this)" style="height: 43px;">
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{auth()->user()->name}}">
            </div>
            <div class="form-group col-md-12">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="{{auth()->user()->email}}" disabled="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputState">Role</label>
                <input class="form-control" value="@if(auth()->user()->role == '1') Admin @else User @endif" disabled="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
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
        view.style.backgroundImage = 'url(' + "'" + e.target.result + "'" + ')';
      };

      reader.readAsDataURL(fileInput.files[0]);
    }
  }
</script>
@endsection
@section("script")
  <script type="text/javascript">
    $(document).on('submit', '.profile-form', function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      var formAction = $(this).attr('action');
      $.ajax({
        type: 'POST',
        url: formAction,
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType: 'json',
        success: function(data)
        {
          if(data.flag == true){
            toastr["success"](data.msg, "Completed!");
            setTimeout(function () {
              location.reload();
            }, 2000);
          }else{
              toastr["error"](data.msg, "Failed!");
          }
        },
        error: function(data){
          console.log(data);
        },
      });
    });
  </script>
@endsection