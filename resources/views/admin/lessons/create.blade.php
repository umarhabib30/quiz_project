<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mb-3">
                        <label for="lesson_name" class="form-label">Lesson Name <span class="text-danger">*</span></label>
                        <input type='text' name="lesson_name" id="lesson_name" class="form-control" required="" data-mask="slugify" data-target="#slug" />
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                        <select name="course_id" id="course_id" class="form-control" required="">
                            <option value="">--Select--</option>
                            @if(count(@$courses) > 0)
                            @foreach(@$courses as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->course_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Create</button>
            <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
        </div>
    </form>
</div>
{{-- <div class="modal-footer">
    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
        Cancel
    </a>
    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
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