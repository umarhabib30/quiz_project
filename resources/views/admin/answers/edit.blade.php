<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">Answer <span class="text-danger">*</span></label>
                            <input type='text' name="title" id="title" value="{{ @$row['title'] }}" class="form-control" required="" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <input type='checkbox' name="is_correct" @if(@$row['is_correct'] == "1") checked @endif id="is_correct" value="1" />
                            <label for="is_correct">Is correct</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
            <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
        </div>
    </form>
</div>
