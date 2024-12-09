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
                        <a href="{{url('admin/teachers/create')}}" class="btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  Teacher
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
                                {{-- @dd($teachers) --}}
                                @if($teachers->count() > 0)
                                @foreach($teachers as $key => $val)
                                <tr class="list_{{ $val[$module['db_key']] }}">
                                    <th scope="row">{{ ($currentPage - 1) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">{{ $val->name }}</td>
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">{{ $val->email }}</td>
                                    @if($val->role == 1)
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">Admin</td>
                                    @elseif($val->role == 2)
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">Teacher</td>
                                    @else
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">Student</td>
                                    @endif
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">{{ $val->gender }}</td>
                                    {{-- Display the creator's name --}}
                                    <td class="pl-0" data-id="{{ $val[$module['db_key']] }}">
                                        {{ $val->creator ? $val->creator->name : 'Unknown' }}
                                    </td>
                                    @if(\Auth::user()->role == 1 || \Auth::user()->role == '0')
                                    <td class="">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('/admin/teachers/edit', $val->id) }}">Edit Teacher</a>
                                                <a class="dropdown-item" href="{{ url('/admin/teachers/delete', $val->id) }}">Delete Teacher</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                {!! $teachers->links() !!}
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
