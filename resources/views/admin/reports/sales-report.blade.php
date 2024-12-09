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
    .pagination {
        margin-top: 10px;
        display: flex;
        justify-content: end;
    }
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="card">
                <form method="get" action="">
                    <div class="card-header">
                    <h2 class="page-title">Search</h2>
                    </div>
                    <div class="row card-body">
                        <div class="col-lg-4 col-md-4">
                            <label for="course_id" class="form-label">Course</label>
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="all" @if(@$course_id == 'all') selected @endif>All</option>
                                @if(!empty($courses))
                                @foreach($courses as $key => $value)
                                <option value="{{ $value->id }}" @if(@$course_id == $value->id) selected @endif>{{ $value->course_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="all" @if(@$user_id == 'all') selected @endif>All</option>
                                @if(!empty($users))
                                @foreach($users as $key => $value)
                                <option value="{{ $value->id }}" @if(@$user_id == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label for="payment_type" class="form-label">Payment Method</label>
                            <select name="payment_type" id="payment_type" class="form-control">
                                <option value="all" @if(@$payment_type == 'all') selected @endif>All</option>
                                <option value="online" @if(@$payment_type == 'online') selected @endif>Credit Card</option>
                                <option value="paypal" @if(@$payment_type == 'paypal') selected @endif>Paypal</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 mt-2">
                            <label for="month_year" class="form-label">Month & Year</label>
                            <input type="month" name="month_year" id="month_year" value="{{ @$month_year }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-md-4 mt-2">
                            <label for="from" class="form-label">From</label>
                            <input type="date" name="from" id="from" value="{{ @$from }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-md-4 mt-2">
                            <label for="to" class="form-label">To</label>
                            <input type="date" name="to" id="to" value="{{ @$to }}" class="form-control">
                        </div>
                        {{-- <div class="col-lg-4 col-md-4 mt-2">
                            <label for="search" class="form-label">Search</label>
                            <input type='text' name="search" id="search" class="form-control" value="{{@$search}}" placeholder="Search here....." />
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary d-none d-sm-inline-block mr-2">Search</button>
                    </div>
                </form>
            </div>
            <div class="col card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h2 class="page-title">
                        Sales Report
                    </h2>
                    @php
                        $url_params = "";
                        if(!empty(@$course_id)){
                            if (empty($url_params)) {
                                $url_params = "?course_id=".@$course_id;
                            } else {
                                $url_params = $url_params."&course_id=".@$course_id;
                            }
                        }
                        if(!empty(@$user_id)){
                            if (empty($url_params)) {
                                $url_params = "?user_id=".@$user_id;
                            } else {
                                $url_params = $url_params."&user_id=".@$user_id;
                            }
                        }
                        if(!empty(@$payment_type)){
                            if (empty($url_params)) {
                                $url_params = "?payment_type=".@$payment_type;
                            } else {
                                $url_params = $url_params."&payment_type=".@$payment_type;
                            }
                        }
                        if(!empty(@$month_year)){
                            if (empty($url_params)) {
                                $url_params = "?month_year=".@$month_year;
                            } else {
                                $url_params = $url_params."&month_year=".@$month_year;
                            }
                        }
                        if(!empty(@$from)){
                            if (empty($url_params)) {
                                $url_params = "?from=".@$from;
                            } else {
                                $url_params = $url_params."&from=".@$from;
                            }
                        }
                        if(!empty(@$to)){
                            if (empty($url_params)) {
                                $url_params = "?to=".@$to;
                            } else {
                                $url_params = $url_params."&to=".@$to;
                            }
                        }
                    @endphp
                    <h2 class="page-title">Total Sale: ${{ $total_sales }} 
                        <div class="col-auto ms-auto d-print-none" style="margin-left: 15px !important;">
                            <a href="{{ url('admin/download-sales-report'.$url_params) }}" class="btn btn-primary export">
                                <i class="fas fa-download" style="margin-right: 5px;"></i> Export
                            </a>
                        </div>
                    </h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table pb-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Course Name</th>
                                    <th>Training Type</th>
                                    <th>Price</th>
                                    <th>Payment Date</th>
                                    <th>Payment Method</th>
                                    {{-- <th class="w-1">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($Course['data']) && sizeof($Course['data'])>0)
                                @foreach($Course['data'] as $key => $val)
                                <tr class="list_{{$val['id']}}">
                                    <th scope="row">{{ ( $currentPage - 1 ) * $perPage + $key + 1 }}</th>
                                    <td class="pl-0" data-id="{{$val['id']}}">{{$val['user']['name']}}</td>
                                    <td class="pl-0" data-id="{{$val['id']}}">{{$val['course']['course_name']}}</td>
                                    <td class="pl-0" data-id="{{$val['id']}}">
                                        @if($val['training_type'] == "session")
                                            <span class="badge p-1" style="background-color: #db1616;">One-to-One Session</span>
                                        @else
                                            <span class="badge p-1" style="background-color: #2c1ea1;">Recorded Training</span>
                                        @endif
                                    </td>
                                    <td class="pl-0" data-id="{{$val['id']}}">${{$val['amount']}}</td>
                                    <td class="pl-0" data-id="{{$val['id']}}">{{date("d, M Y", strtotime($val['created_at']))}}</td>
                                    <td class="pl-0" data-id="{{$val['id']}}">
                                        @if($val['orders']['payment_type'] == "online")
                                            <span class="badge p-1" style="background-color: #33b524;">Credit Card</span>
                                        @else
                                            <span class="badge p-1" style="background-color: #33b524;">Paypal</span>
                                        @endif
                                    </td>
                                    {{-- <td class="">
                                        <a class="btn btn-success" href="{{ url('admin/course-progress', $val['id']) }}">View Progress</a>
                                    </td> --}}
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">No result found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {!! $Course['pagination'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection