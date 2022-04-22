@extends('layouts.app')

@section('content')
    <div>
        <div class="container form">
            <br>
            <br>
            <h3 style="color: rgb(51, 60, 131);
            font-weight: 600;
            font-size: 1.3em;">
                Create A New Course
            </h3>
            <br>
            <form method="POST" action="/courses">

                @csrf
                <div class="form-group">
                    <label for="title" class="label">Course Name</label>
                    <input type="text" name="name" class="form-control input" aria-describedby="emailHelp">
                    <label for="" class="text-danger">
                        {{ $errors->first('name') }}
                    </label>
                </div>

                <div class="form-group">
                    <label for="description" class="label">Course description</label>
                    <input type="text" name="description" class="form-control input" aria-describedby="emailHelp">
                    <label for="" class="text-danger">
                        {{ $errors->first('description') }}
                    </label>
                </div>

                <div class="form-group">
                    <label for="title" class="label">Course Duration</label>
                    <input type="number" name="duration" class="form-control input" aria-describedby="emailHelp">
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
