@extends('layouts.admin')
@section('content')
@if(Auth::user()->role != '3')
<div class="page-body">
  <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Students</div>
              <div class="ms-auto lh-1"></div>
            </div>
            <div class="h1 mb-3">{{ @$students }}</div>
            <div class="progress progress-sm">
              <div 
              class="progress-bar bg-blue" 
              style="width: {{ min(max(@$students, 0), 100) }}%;" 
              role="progressbar" 
              aria-valuenow="{{ min(max(@$students, 0), 100) }}" 
              aria-valuemin="0" 
              aria-valuemax="100">
              <span class="visually-hidden">{{ @$students }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Teachers</div>
              <div class="ms-auto lh-1"></div>
            </div>
            <div class="h1 mb-3">{{ @$teachers }}</div>
            <div class="progress progress-sm">
              <div 
              class="progress-bar bg-blue" 
              style="width: {{ min(max(@$teachers, 0), 100) }}%;" 
              role="progressbar" 
              aria-valuenow="{{ min(max(@$teachers, 0), 100) }}" 
              aria-valuemin="0" 
              aria-valuemax="100">
              <span class="visually-hidden">{{ @$teachers }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Classes</div>
              <div class="ms-auto lh-1"></div>
            </div>
            <div class="h1 mb-3">{{ @$classes }}</div>
            <div class="progress progress-sm">
              <div 
              class="progress-bar bg-blue" 
              style="width: {{ min(max(@$classes, 0), 100) }}%;" 
              role="progressbar" 
              aria-valuenow="{{ min(max(@$classes, 0), 100) }}" 
              aria-valuemin="0" 
              aria-valuemax="100">
              <span class="visually-hidden">{{ @$classes }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Quiz</div>
            <div class="ms-auto lh-1"></div>
          </div>
          <div class="h1 mb-3">{{ @$quiz }}</div>
          <div class="progress progress-sm">
            <div 
            class="progress-bar bg-blue" 
            style="width: {{ min(max(@$quiz, 0), 100) }}%;" 
            role="progressbar" 
            aria-valuenow="{{ min(max(@$quiz, 0), 100) }}" 
            aria-valuemin="0" 
            aria-valuemax="100">
            <span class="visually-hidden">{{ @$quiz }}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
</div>
</div>
@else
<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Redirect to the desired URL after the page loads
      window.location.href = "{{ url('student/quiz') }}";
  });
</script>
@endif
@endsection
