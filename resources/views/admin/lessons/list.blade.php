@extends('layouts.admin')
@section('content')
<style type="text/css">
    .card-body .dropdown-menu.dropdown-menu-end.show{
        right: 197px !important;
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

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h2 class="page-title">
                        {{@$page_title}}
                    </h2>
                    @if(\Auth::user()->role==1)
                    <div class="card-actions card-toolbar">
                        <!--begin::Button-->
                        <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/create" data-action="data_modal" class="btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  {{@$module['singular']}}
                            </span>
                        </a>                              
                    </div>
                    @endif
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table" data-url="{{$action}}/edit">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Lesson Name</th>
                                        <th>Course Name</th>
                                        <th>Chapters</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($Lessons['data']) && sizeof($Lessons['data'])>0)
                                    @foreach($Lessons['data'] as $key => $val)
                                    <tr class="list_{{$val[$module['db_key']]}}">
                                        <th scope="row">{{++$key}}</th>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="lesson_name">{{$val['lesson_name']}}</td>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="course_name">{{$val['course']['course_name']}}</td>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="course_name">{{count($val['chapters'])}}</td>
                                        {{-- <td class="pl-0">{{date('Y-m-d',strtotime($val['created_at']))}}</td> --}}
                                        <td class="pr-0 text-right">
                                           {{--  <span class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ url('admin/chapter/'.$val['course'][$module['db_key']].'/'.$val[$module['db_key']]) }}">
                                                        View Chapters
                                                    </a>
                                                    <a class="dropdown-item" href="#data_modal" data-toggle="modal" data-url="{{$action}}/edit/{{$val[$module['db_key']]}}" data-action="data_modal">
                                                        Edit Lesson
                                                    </a>
                                                    <a class="dropdown-item" href="{{url($module['action'].'/delete/'.$val[$module['db_key']])}}">
                                                        Delete Lesson
                                                    </a>
                                                </div>
                                            </span> --}}
                                            <div class="btn-group dropleft">
                                          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                           <a class="dropdown-item" href="{{ url('admin/chapter/'.$val['course'][$module['db_key']].'/'.$val[$module['db_key']]) }}">View Chapters</a>
                                           <a class="dropdown-item" href="#data_modal" data-toggle="modal" data-url="{{$action}}/edit/{{$val[$module['db_key']]}}" data-action="data_modal">
                                                        Edit Lesson </a>
                                           <a class="dropdown-item" href="{{url($module['action'].'/delete/'.$val[$module['db_key']])}}">Delete Lesson</a>
                                       </div>
                                   </div>
                                            {{-- <a href="{{$action}}/edit/{{$val[$module['db_key']]}}"> --}}
                                                {{-- Edit --}}
                                            {{-- </a> --}}
                                            {{-- <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/edit/{{$val[$module['db_key']]}}" data-action="data_modal" class="btn btn-primary d-none d-sm-inline-block"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            
                                            <a data-action="delete_record" href="javascript:void(0);" class="btn btn-danger d-none d-sm-inline-block mt-2" data-url="{{url($module['action'].'/delete/'.$val[$module['db_key']])}}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    {!! $Lessons['pagination'] !!}
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No lesson found</td>
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