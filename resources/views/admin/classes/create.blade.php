@extends('layouts.admin')

@section('content')
<div class="page-header d-print-none mb-5">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col card">
				<div class="card-header">
					<h5 class="card-title">{{@$page_title}}</h5>
				</div>
				<div class="card-body">
					<form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload"> 
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="name" class="form-label">CLass Name</label>
										<input type='text' name="name" id="name" class="form-control" required="" data-target="#slug" />
									</div>
								</div>

								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="slug" class="form-label">Class Number</label>
										<input type='text' name="number" id="number" class="form-control" required=""/>
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
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).on("keyup", '#name', function(event) {
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
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  $(document).ready(function () {
    CKEDITOR.replace('short_detail');
  });
</script> --}}
