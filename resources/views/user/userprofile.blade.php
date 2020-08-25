@extends('layouts.app')

@section('content')
<div class="row nopadding">
    <div class="col-2 bg-white nopadding" style="height: 100vh;">
        <div class="container py-3">
            @if (empty(Auth::user()->avatar))
            <div class="px-1 text-center pt-5 pb-3">
                <h5>{{Auth::user()->name}}</h5><br>
                <div class="pb-5">
                    <small>{{Auth::user()->usertype}}</small>
                </div>
                <small>Click below to update your profile</small>
                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">Add photo</button>
                </div>
            @else
            <div class="px-1 text-center py-3">
                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" alt="..." class="rounded-circle" width="120"><br>
                <h5>{{Auth::user()->name}}</h5><br>
                <small>{{Auth::user()->usertype}}</small>
            </div> 
            @endif
            <div class="px-1">
                <a href="/userdashboard" class="text-decoration-none text-secondary">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/userdashboard/myprofile" class="text-decoration-none text-secondary active">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>My Profile</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container py-4">
            <div class="card w-75 m-auto">
                <div class="card-header">
                    <h5 class="nopadding">Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row nopadding">
                        <div class="col-3 nopadding">
                            <div class="container text-center">
                                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" alt="" width="150">
                                <button class="btn btn-block btn-primary mt-4">Update Profile Photo</button>
                            </div>
                        </div>
                        <div class="col nopadding">
                            <div class="container">
                                <form action="/userdashboard/updateProfile/{{Auth::user()->id}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="" value="{{Auth::user()->name}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" value="{{Auth::user()->email}}" class="form-control">
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <h5>Welcome admin!</h5>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
