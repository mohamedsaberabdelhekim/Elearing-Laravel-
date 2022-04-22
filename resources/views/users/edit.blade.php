@extends('layouts.app')

@section('content')
<div class="profile">
    <div class="container " style="display:flex;justify-content:center;">
        <div class="card" style="border:none;background-color:rgba(255, 255, 255, 0.671); width:90%;min-height:90vh;padding:0 1rem">
            <br>
            <br>
            <h5 class="card-title"  style="font-size:1.6em ;color: rgba(121, 74, 122, 0.801);font-weight: 600;">Edit Profile</h5>
            <hr>
            <br>
            <form method="POST" action="{{ route('user.update',$user) }}">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" value="{{$user['name']}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>               
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="enroll-btn">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>
    </div>
</div>
@endsection