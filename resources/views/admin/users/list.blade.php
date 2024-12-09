@extends('layouts.admin')
@section('content')
<div class="page-header d-print-none mb-5">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h2 class="page-title">
                        {{@$page_title}}
                    </h2>
                    @if(\Auth::user()->role==1 || Auth()->user()->role == '0')
                    <div class="card-actions card-toolbar">
                        <!--begin::Button-->
                        <a href="{{url('admin/users/create')}}"  class="btn btn-success d-none d-sm-inline-block">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th>Created By</th>
                                    @if(\Auth::user()->role==1 || Auth()->user()->role == '0')
                                    <th class="w-1">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($Course) && sizeof($Course) > 0)
                                @foreach($Course as $key => $val)
                                <tr class="list_{{$val[$module['db_key']]}}">
                                    <th scope="row">{{ ( $currentPage - 1 ) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val->name}}</td>
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">{{$val->email}}</td>
                                    @if($val->role == '0')
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">Super Admin</td>
                                    @elseif($val->role == '1')
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">Admin</td>
                                    @elseif($val->role == '2')
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">Teacher</td>
                                    @else
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">Student</td>
                                    @endif

                                    {{-- Display the creator's name --}}
                                    <td class="pl-0" data-id="{{$val[$module['db_key']]}}">
                                        {{ $val->creator ? $val->creator->name : 'Unknown' }}
                                    </td>
                                    <td class="pl-0">{{ date('Y-m-d', strtotime($val->created_at)) }}</td>

                                    @if(\Auth::user()->role == 1 || Auth::user()->role == '0')
                                    <td class="">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{url('admin/users/edit', $val->id)}}">Edit Admin</a>
                                                @if($val->role == 0)
                                                <a class="dropdown-item text-muted" href="javascript:void(0);" title="Cannot delete super admin" style="pointer-events: none;">Delete Admin (Disabled)</a>
                                                @else
                                                <a class="dropdown-item" data-action="delete_record" href="{{url('admin/users/delete/'.$val->id)}}" data-url="{{url('admin/users/delete/'.$val->id)}}">Delete Admin</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                {!! $Course['pagination'] !!}
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
