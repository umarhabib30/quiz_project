@extends('layouts.admin')
@section('content')
<style type="text/css">
    .card-body .dropdown-menu.dropdown-menu-end.show{
        right: 200px !important;
        bottom: 10px !important
    }
    .relative {
        color: #182433 !important;
    }
    @media(max-width: 575px) {
        .dropdown-menu.dropdown-menu-end.show{
            right: 0px !important;
        }
    }
</style>

<div class="page-header d-print-none mb-5">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card mt-3">
                <div class="card-header">
                    <h2 class="page-title">
                        {{@$page_title}}
                    </h2>
                    @if(\Auth::user()->role==2)
                    <div class="card-actions card-toolbar">
                        <a href="{{url('teacher/questions/' .$quizid. '/create')}}" class="btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  {{@$module['singular']}}
                            </span>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table" data-url="{{url('teacher/quiz/edit')}}">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Quiz</th>
                                    @if(\Auth::user()->role==2)
                                    <th class="w-1">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($questions['data']) && sizeof($questions['data'])>0)
                                @foreach($questions['data'] as $key => $val)
                                <tr class="list_{{$val[$module['db_key']]}}">
                                    <th scope="row">{{ ( $currentPage - 1 ) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['question']}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['quiz']['title']}}</td>
                                    @if(\Auth::user()->role==2)
                                    <td class="">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                              <!-- <a class="dropdown-item" href="{{ url('/questions/create', $val['id'] ) }}">Add Questions</a> -->
                                              <a class="dropdown-item" href="{{ url('teacher/questions/' . $quizid . '/edit/' . $val['id']) }}">Edit Question</a>
                                              <a class="dropdown-item" href="{{ url('teacher/questions/' . $quizid . '/delete/' . $val['id']) }}">Delete Question</a>
                                          </div>
                                      </div>
                                  </td>
                                  @endif
                              </tr>
                              @endforeach
                              {!! $questions['pagination'] !!}
                              @else
                              <tr>
                                <td colspan="10" class="text-center">No Quiz found. <a href="{{url('teacher/questions/' .$quizid. '/create')}}" class="d-none d-sm-inline-block">
                                    <span class="svg-icon svg-icon-md">
                                        + Add  {{@$module['singular']}}
                                    </span>
                                </a></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    document.querySelectorAll('.dropdown-item[href*="delete"]').forEach((element) => {
        element.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this question?')) {
                window.location.href = this.getAttribute('href');
            }
        });
    });

</script>
@endsection
