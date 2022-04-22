@extends('layouts.app')

@section('content')
<div class="container">
    <div class="banner-2"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
               
                <br>
                <h3>Welcome Back! </h3>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    @if(auth()->user()->role == 'student')
                    <a href="{{ route('user.enrollments',auth()->user())}}" class="enroll-btn">Start</a>
                    @endif
                    @if(auth()->user()->role == 'teacher')
                    <a href="{{ route('user.courses',auth()->user())}}" class="enroll-btn">Start</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
