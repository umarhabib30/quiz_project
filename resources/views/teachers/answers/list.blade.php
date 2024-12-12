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
                    <!-- @if(\Auth::user()->role==1)
                    <div class="card-actions card-toolbar">
                        <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/create" data-action="data_modal" class="btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  {{@$module['singular']}}
                            </span>
                        </a>                              
                    </div>
                    @endif -->
                </div>
                <div class="card-body">
                    <h3>Class: {{ $class->name }}</h3>
                    <h4>Quiz: {{ $quiz->title }}</h4>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <a href="{{ url('check/answers/' . $quiz->id . '/' . $student->id) }}">Check Answers</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No students assigned for this quiz.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection