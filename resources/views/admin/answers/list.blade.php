@extends('layouts.admin')
@section('content')

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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Is Correct</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($Answers['data']) && sizeof($Answers['data'])>0)
                                    @foreach($Answers['data'] as $key => $val)
                                    <tr class="list_{{$val[$module['db_key']]}}">
                                        <th scope="row">{{++$key}}</th>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="qustion">{{$val['question']['title']}}</td>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="title">{{$val['title']}}</td>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="is_correct">@if($val['is_correct'] == "1") <span class="badge badge-success" style="background: #2fb344;">Correct</span> @else <span class="badge badge-danger" style="background: #d63939;">Wrong</span> @endif</td>
                                        <td class="pr-0 text-right">
                                            <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/edit/{{$val[$module['db_key']]}}" data-action="data_modal" class="btn btn-primary d-none d-sm-inline-block"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            
                                            <a data-action="delete_record" href="javascript:void(0);" class="btn btn-danger d-none d-sm-inline-block mt-2" data-url="{{url($module['action'].'/delete/'.$val[$module['db_key']])}}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {!! $Answers['pagination'] !!}
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No answer found</td>
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