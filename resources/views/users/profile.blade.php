@extends('layouts.app')

@section('content')
<div class="profile">
    <div class="container " style="display:flex;justify-content:center;">
        <div class="card" style="border:none;background-color:rgba(255, 255, 255, 0.671); width:80%;min-height:90vh">
             <div style="text-align: right;padding:0 1rem">
                <form action="/user/{{$user['id']}}" method="POST">
                    @method("delete")
                    @csrf
                      <br>
                      <input type="submit" name="delete" id="" value="Delete Account"  class="enroll-btn" >
                </form>
             </div>
            <div class="card-body">
                @if($update == 'Profile Updated Successfully.')
                <div class="alert alert-success" role="alert">
                    {{ $update }}
                </div>
                @endif
                <br>
              <h5 class="card-title"  style="font-size:1.6em ;color: rgba(121, 74, 122, 0.801);font-weight: 600;">My Profile</h5>
              <hr>
              <img src="../../../storage/images/{{$user['id']}}/{{$user['image']}}" width="200px" style="box-shadow: 0 15px 20px rgba(0, 0, 0, 0.37);;border:2px solid rgba(121, 74, 122, 0.801);border-radius:10px" alt="" >
              <br>
              <br>
              <h6 class="card-title"  style="font-size:1.4em ;color: #333;font-weight: 600;">Name: <span class="card-text" style="font-size:1em ;color: #333; font-weight:400">{{$user['name']}}</span></h6>
              <h6 class="card-title"  style="font-size:1.4em ;color: #333;font-weight: 600;">Email: <span class="card-text" style="font-size:1em ;color: #333; font-weight:400">{{$user['email']}}</span></h6>
              <h6 class="card-title"  style="font-size:1.4em ;color: #333;font-weight: 600;">Role: <span class="card-text" style="font-size:1em ;color: #333; font-weight:400">{{$user['role']}}</span></h6>
              <br>
              <a href="{{route('user.edit',$user['id'])}}" class="enroll-btn">Edit Profile</a>
            </div>
          </div>
    </div>
</div>
@endsection