@extends('layouts.app')

@section('content')
    <div>
        <div class="container form">
            <br>
            <br>
            <h3 style="color: rgba(121, 74, 122, 0.959);
            font-weight: 600;
            font-size: 1.3em;">
                Edit Course
            </h3>
            <br>
            <form method="POST" action="{{ route('courses.update', $course) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title" class="label">Course Name</label>
                    <input type="text" name="name" class="form-control input" aria-describedby="emailHelp"
                        value="{{ $course['name'] }}">
                    <label for="" class="text-danger">
                        {{ $errors->first('name') }}
                    </label>
                </div>

                <div class="form-group">
                    <label for="description" class="label">Course description</label>
                    <input type="text" name="description" class="form-control input" aria-describedby="emailHelp"
                        value="{{ $course['description'] }}">
                    <label for="" class="text-danger">
                        {{ $errors->first('description') }}
                    </label>
                </div>

                <div class="form-group">
                    <label for="title" class="label">Course Duration</label>
                    <input type="number" name="duration" class="form-control input" aria-describedby="emailHelp"
                        value="{{ $course['duration'] }}">
                    <label for="" class="text-danger">
                        {{ $errors->first('duration') }}
                    </label>
                </div>
                <br>
                <button type="submit" class="enroll-btn">Submit</button>
            </form>
        </div>
    </div>
@endsection
