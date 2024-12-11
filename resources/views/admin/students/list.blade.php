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
            <div class="card">
                <form method="get" action="">
                    <div class="card-header">
                        <h2 class="page-title">Search</h2>
                    </div>
                    <div class="row card-body">
                        <div class="col-lg-4 col-md-4">
                            <label for="search" class="form-label">Search</label>
                            <input type='text' name="search" id="search" class="form-control" value="{{@$search}}" placeholder="Search here....." />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary d-none d-sm-inline-block mr-2">Search</button>
                    </div>
                </form>
            </div>
            <div class="col card mt-3">
                <div class="card-header">
                    <h2 class="page-title">
                        {{@$page_title}}
                    </h2>
                    @if(\Auth::user()->role==1 || Auth()->user()->role == '0')
                    <div class="card-actions card-toolbar">
                        <a href="{{url('admin/students/create')}}" class="btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  {{@$module['singular']}}
                            </span>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table" data-url="{{url('admin/students/edit')}}">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <!-- <th>Class</th> -->
                                    <th>Role</th>
                                    <th>Created By</th>
                                    <th>Gender</th>
                                    @if(\Auth::user()->role==1 || Auth()->user()->role == '0')
                                    <th class="w-1">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($Student['data']) && sizeof($Student['data'])>0)
                                @foreach($Student['data'] as $key => $val)
                                <tr class="list_{{$val[$module['db_key']]}}">
                                    <th scope="row">{{ ( $currentPage - 1 ) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['name']}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['email']}}</td>
                                    <!-- <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['class']['name'] ?? 'N/A'}}</td> -->
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">@if($val['role'] == '3') Student @endif</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['creator']['name'] ?? 'N/A'}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val['gender']}}</td>
                                    @if(\Auth::user()->role == 1 || Auth()->user()->role == '0')
                                    <td class="">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{url('admin/students/edit', $val['id'])}}">Edit Student</a>
                                                <a class="dropdown-item" href="{{url('admin/students/delete', $val['id'])}}">Delete Student</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                {!! $Student['pagination'] !!}
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">No Student found. <a href="#data_modal" data-toggle="modal" data-url="{{url('admin/students/create')}}" class="d-none d-sm-inline-block" data-action="data_modal">
                                        <span class="svg-icon svg-icon-md">+ Add {{@$module['singular']}}</span>
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
