<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Title</label>
                        <input type='text' name="title" id="name" class="form-control" required="" data-mask="slugify"  data-target="#slug" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Slug</label>
                        <input type='text' name="slug" id="slug" class="form-control" required="" readonly />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="detail" class="form-label">Category Description</label>
                        <input type='text' name="category_description" id="cc_slug" class="form-control" required="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="detail" class="form-label">Category Image</label>
                        <input type='file' name="image" id="detail" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="detail" class="control-label">Show As Top</label>
                        <input type='checkbox' name="top" id="top" />
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