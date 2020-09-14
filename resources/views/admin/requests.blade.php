@extends('layouts.app')

@section('content')

<div class="row nopadding">
    <div class="col-2 bg-light nopadding" style="height: 100vh;">
        <div class="container py-3">
            @if (empty(Auth::user()->avatar))
            <div class="px-1 text-center pt-5 pb-3">
                <h5>{{Auth::user()->name}}</h5><br>
                <div class="pb-5">
                    <small>{{Auth::user()->usertype}} /</small>
                    <small>{{Auth::user()->position}}</small><br>
                    @isset($dept_name)
                        <small>{{$dept_name->department_name}} Department</small>
                    @endisset
                </div>
                <small>Click below to update your profile</small>
                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">Add photo</button>
            </div>
            @else
            <div class="px-1 text-center py-3">
                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" alt="..." class="rounded-circle img-fluid" width="120"><br>
                <h5>{{Auth::user()->name}}</h5><br>
                <small>{{Auth::user()->usertype}} /</small>
                <small>{{Auth::user()->position}}</small><br>
                @isset($dept_name)
                    <small>{{$dept_name->department_name}} Department</small>
                @endisset
            </div> 
            @endif
            <div class="px-1">
                <a href="/admindashboard" class="text-decoration-none text-secondary">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/users" class="text-decoration-none text-secondary ">
                    <i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Users</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/requests" class="active text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/items" class="text-decoration-none text-secondary"><i class="fas fa-people-carry"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Items</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container mt-2">
            <div class="card">
                <div class="card-header">
                    <h5>Item Requests</h5>
                    @isset($dept_name)
                        <small>Department: </small><small class="text-primary">{{$dept_name->department_name}}</small>
                    @endisset
                </div>
                <div class="card-body">
                    <div class="container">
                        <table id="requestsTable">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection