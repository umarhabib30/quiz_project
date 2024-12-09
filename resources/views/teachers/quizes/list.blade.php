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
                        <a href="{{url('teacher/quiz/create')}}" class="btn btn-success d-none d-sm-inline-block">
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
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Start Time (HH:MM)</th>
                                    <th>Date (YYYY-MM-DD)</th>
                                    @if(\Auth::user()->role==2)
                                    <th class="w-1">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($quizes['data']) && sizeof($quizes['data'])>0)
                                @foreach($quizes['data'] as $key => $val)
                                <tr class="list_{{$val[$module['db_key']]}}">
                                    <th scope="row">{{ ( $currentPage - 1 ) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['title']}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['class']['name']}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">
                                        {{ \Carbon\Carbon::parse($val['start_time'])->format('H:i') }}
                                    </td>

                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">
                                        {{ \Carbon\Carbon::parse($val['start_date'])->format('Y-m-d') }}
                                    </td>

                                    @if(\Auth::user()->role==2)
                                    <td class="">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{ url('teacher/questions/'. $val['id'] . '/create') }}">Add Questions</a>
                                              <a class="dropdown-item" href="{{ url('teacher/questions/'. $val['id'] ) }}">View Questions</a>
                                              <a class="dropdown-item" href="{{url('teacher/quiz/edit', $val['id'])}}">Edit Quiz</a>
                                              <a class="dropdown-item" href="{{url('teacher/quiz/delete', $val['id'])}}">Delete Quiz</a>
                                          </div>
                                      </div>
                                  </td>
                                  @endif
                              </tr>
                              @endforeach
                              {!! $quizes['pagination'] !!}
                              @else
                              <tr>
                                <td colspan="10" class="text-center">No Quiz found. <a href="{{url('teacher/quiz/create')}}" class="d-none d-sm-inline-block">
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
@endsection
