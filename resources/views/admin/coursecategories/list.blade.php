@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">
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
                            <table id="example" class="table table-striped table-bordered" data-url="{{$action}}/edit">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        @if(\Auth::user()->role==1)
                                        <th class="w-1">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($CourseCategories['data']) && sizeof($CourseCategories['data'])>0)
                                    @foreach($CourseCategories['data'] as $key => $val)
                                    <tr class="list_{{$val[$module['db_key']]}}">
                                        <th scope="row">{{++$key}}</th>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="title">{{$val['title']}}</td>
                                        <td class="pl-0" data-id="{{$val[$module['db_key']]}}" data-input="text" data-field="category_description">{{$val['category_description']}}</td>
                                        {{-- <td class="pl-0">{{date('Y-m-d',strtotime($val['created_at']))}}</td> --}}
                                        @if(\Auth::user()->role==1)
                                        <td class="pr-0 text-right">
                                            {{-- <a href="{{$action}}/edit/{{$val[$module['db_key']]}}"> --}}
                                                {{-- Edit --}}
                                            {{-- </a> --}}
                                            <a href="#data_modal" data-toggle="modal"  data-url="{{$action}}/edit/{{$val[$module['db_key']]}}" data-action="data_modal" class="btn btn-primary d-none d-sm-inline-block"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            
                                            <a data-action="delete_record" href="javascript:void(0);" class="btn btn-danger d-none d-sm-inline-block mt-2" data-url="{{url($module['action'].'/delete/'.$val[$module['db_key']])}}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    {!! $CourseCategories['pagination'] !!}
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">No category found</td>
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
<script type="text/javascript" src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
   new DataTable('#example', {
    columnDefs: [
        {
            render: (data, type, row) => data + ' (' + row[3] + ')',
            targets: 0
        },
        { visible: false, targets: [3] }
    ]
});
</script>
@endsection