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
                        <label for="name" class="control-label">Category Title</label>
                        <input type='text' name="title" id="title" class="form-control" value="{{@$row['title']}}" required="" data-mask="slugify" data-target="#slug" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Slug</label>
                        <input type='text' name="slug" id="slug" class="form-control" required="" value="{{@$row['slug']}}" readonly />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="detail" class="control-label">Category Description</label>
                        <input type='text' name="category_description" id="category_description" value="{{@$row['category_description']}}" class="form-control" required="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="detail" class="control-label">Category Image</label>
                        <input type='file' name="image" id="detail" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="detail" class="control-label">Show As Top</label>
                        <input type='checkbox' name="top" id="top" value="1" @if(@$row['top'] == 1) checked @endif />
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
