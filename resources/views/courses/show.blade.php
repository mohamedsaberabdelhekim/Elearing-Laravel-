@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="banner"></div> --}}
        @if (Session::has('message'))
            <br>
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <br>
        <div class="content">
            <div style="">
                <div class="card-body">
                    <h2 class="card-title">{{ $course['name'] }}</h2>
                    <h5 class="card-subtitle mb-2 text-muted">Created By: {{ $course->user->name }}</h5>
                    <h5 class="card-title">
                        Description:
                    </h5>
                    <p class="card-text" style="width:50%">{{ $course['description'] }}.</p>

                    <br>
                    @if (auth()->user()->role == 'student')
                        <a href="/enrolling/{{ $course['id'] }}" class="enroll-btn">Enroll</a>
                        <br>
                    @endif
                    <br>
                    <hr style="margin: 0">
                    <div>
                        <br>

                        <br>
                        <br>
                        @foreach ($course->reviews as $review)
                            <div style="width:30rem;border:1px solid #fff; border-radius:20px">
                                <div style="width:30rem">
                                    <span
                                        style="border-radius:20px;width:30rem;background-color:rgba(238, 238, 238, 0.856);display:inline-block;padding:0.5rem 1rem;">
                                        <h5 style="font-size:1.1em;color:rgb(121, 74, 122);font-weight:600"><img
                                                src="../../../storage/images/{{ $review->user['id'] }}/{{ $review->user['image'] }}"
                                                width="50px" height="50px" style="border-radius: 50%; margin-right:0.3rem"
                                                alt="">{{ $review->user['name'] }} | {{ $review['created_at'] }}</h5>
                                        <p style="font-size:1.1em;padding-bottom:0;margin-bottom:0"">{{ $review->body }}</p>
                                              @if ($review->user->id == auth()->user()->id)
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                            style="display: inline">
                                            @method("delete")
                                            @csrf
                                            <input type="submit" name="delete" id="" value="Delete" class=""
                                                style="background-color: rgba(121, 74, 122, 0.836);padding:0.3rem 1rem; color:#fff;border:none">
                                        </form>
                        @endif
                        </span>
                    </div>
                </div>
                <br>
                @endforeach


                <form method="POST" action="{{ route('reviews.store') }}" style="width:50rem">
                    @csrf
                    <div class="form-group">
                        <label for="body" style="color:rgb(136 49 124 / 100%);font-weight:600">Add Review</label>
                        <br>
                        <input type="text" name="body" class="form-control" aria-describedby="emailHelp"
                            style="background-color:rgba(238, 238, 238, 0.815);border:2px solid #fff;width:30rem;display:inline-block">
                        <button type="submit" class="btn text-light"
                            style="background-color:rgb(121, 74, 122, 0.836);display:inline">Add</button>
                        <label for="" class="text-danger">
                            {{ $errors->first('body') }}
                        </label>
                        <input type="number" hidden name="course_id" class="form-control" aria-describedby="emailHelp"
                            value="{{ $course['id'] }}">
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
