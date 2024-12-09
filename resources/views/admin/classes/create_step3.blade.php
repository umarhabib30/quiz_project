@extends('layouts.admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h5 class="card-title">Create Quiz Exam</h5>
                </div>
                <form class="" method="post" action="{{url('admin/course/create-step3')}}" enctype="multipart/form-data" data-action="make_ajax_file">
                    <div class="card-body">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="quiz_title" class="form-label">Quiz title</label>
                                        <input type='text' name="quiz_title" id="quiz_title" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="quiz_description" class="form-label">Quiz description</label>
                                        <textarea name="quiz_description" id="quiz_description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="pass_marks" class="form-label">Pass marks</label>
                                        <input type='number' name="pass_marks" id="pass_marks" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="time_duration" class="form-label">Time duration(in minutes)</label>
                                    <input type='number' name="time_duration" id="time_duration" class="form-control" />
                                    <input type="hidden" name="course_id" value="{{request()->route('id')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Save</button>
                        <a  class="btn btn-success" href="{{url('/admin/course/create-step3/'.request()->route('id'))}}">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <hr/>
        <h1>Avaialable trainings</h1>

        @foreach($topics as $key => $topic)
        <div class="accordion mb-3" id="accordionExample{{$key}} ">
            <div class="accordion-item bg-white">
                <h2 class="accordion-header" id="headingOne{{$key}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                        <img src="{{asset('assets/images/ac-icon.png')}}"><span class="mx-5">Training ({{$topic->topic_name}})</span>
                    </button>
                </h2>
                <div id="collapseOne{{$key}}" class="accordion-collapse collapse bg-white pt-0" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample{{$key}}">
                    <div class="accordion-body">
                        <div class="row g-2 align-items-center">
                            <hr class="mt-0" />
                            <div class="col">
                                <form class="" method="post" action="{{url('admin/course/create-step2')}}" enctype="multipart/form-data" data-action="make_ajax_file">
                                    <div class="card-body">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="topic_name" class="form-label">Training title</label>
                                                        <input type='text' value="{{@$topic->topic_name}}" name="topic_name" id="topic_name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="video_url" class="form-label">Training video</label>
                                                        <input type='file' value="{{@$topic->video_url}}" name="video_url" id="video_url" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <label for="topic_summary" class="form-label">Training Detail</label>
                                                    <textarea name="topic_summary" id="topic_summary" class="form-control">{{@$topic->topic_summary}}</textarea>
                                                    <input type="hidden" name="course_id" value="{{request()->route('id')}}">
                                                    <input type="hidden" name="topic_id" value="{{@$topic->id}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

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