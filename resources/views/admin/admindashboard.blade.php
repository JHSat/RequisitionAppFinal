@extends('layouts.app')

@section('content')
{{-- modal  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Profile Photo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="admindashboard/uploadPhoto/" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Select a file</label> <br>
                    <input type="file" name="image" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="upload">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- end modal  --}}
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
                <a href="" class="text-decoration-none text-secondary active">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/users" class="text-decoration-none text-secondary">
                    <i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Users</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/items" class="text-decoration-none text-secondary"><i class="fas fa-people-carry"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Items</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container py-5">
            <div class="row nopadding">
                <div class="col nopadding">
                    <div class="card w-50 ml-4 float-right mr-5">
                        <div class="card-header">
                            Requests
                        </div>
                        <div class="card-body">
                            <div class="py-2 text-center">
                                <span style="font-size: 70px;">{{count($itemCount)}}</span>
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block"> View </button>
                        </div>
                    </div>
                </div>
                <div class="col nopadding">
                    <div class="card w-50 float-left ml-5">
                        <div class="card-header">
                            Registered Users
                        </div>
                        <div class="card-body">
                            <div class="py-2 text-center">
                                <span style="font-size: 70px;">{{count($userCount)}}</span>
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block"> View </button>
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
