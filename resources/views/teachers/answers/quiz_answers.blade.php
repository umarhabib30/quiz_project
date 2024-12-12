@extends('layouts.admin')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-body">
                    <h3>Quiz: {{ $quiz->title }}</h3>
                    <h4>Student: {{ $student->name }}</h4>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer Video</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $key => $question)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        @if (isset($answersByQuestion[$question->id]))
                                        <ul>
                                            @foreach ($answersByQuestion[$question->id] as $answer)
                                            <li>
                                                <a href="{{ asset('storage/' . $answer->video) }}" target="_blank">View Answer</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        No answers submitted yet.
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No questions found for this quiz.</td>
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