{{-- @dd($userEnrollments); --}}

@extends('layouts.app')

@section("content")

{{-- @dd($courses); --}}

<nav class="shadow-sm"
style="background-color: rgba(121, 74, 122, 0.308);
padding:0.2rem 0;
">
    <div class="container start">
        <a class="navbar-brand" href="/courses">
           All Courses
        </a>
    </div>
</nav>
<div>
    <div class="container">
        @if(Session::has('message'))
        <br>
        <p class="alert alert-info">{{ Session::get('message') }}</p>
      @endif
    </div>
    <br>
    <div class="container courses-container" style="min-height: 80vh">
         @foreach ($userEnrollments as $course)
         <div class="card mb-3" style="border:0;background:none" id="course-img">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="/images/course.jpg" class="img-fluid rounded-start" alt="" width="100%">
              </div>
              <div class="col-md-8 bg-white">
                <div class="card-body">
                  <h5 class="card-title" style="font-size:1.4em ;color: rgba(121, 74, 122, 0.801);font-weight: 600;">{{$course['name']}} Course</h5>
                  <p class="card-text" style="font-size:1em ;color: #555;">{{$course['description']}}</p>
                  <p class="card-text"><span style="font-size:1em ;color: rgba(121, 74, 122, 0.801);">Duration: </span>{{$course['duration']}}</p>
                   <br>
                   <div style="display: flex">
                    <a href="{{route('courses.show',$course['id'])}}" class="enroll-btn" style="margin-right: 0.5rem">Details</a>
                    <a href="/unenrolling/{{$course['id']}}" class="enroll-btn">Remove</a>
                   </div>
                </div>
              </div>
            </div>
        </div>
         @endforeach
  </div>
</div>

@endsection
