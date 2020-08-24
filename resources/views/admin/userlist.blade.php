@extends('layouts.app')

@section('content')

<div class="row nopadding">
    <div class="col-2 bg-light nopadding" style="height: 100vh;">
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
                <a href="/admindashboard" class="text-decoration-none text-secondary">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/users" class="text-decoration-none text-secondary active">
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
        <div class="container">
            <div class="card ml-auto mr-auto w-75 my-4">
                <div class="card-header">
                    <h5 class="py-3">Employees</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Email</td>
                                <td class="text-right">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($user) > 0)
                                @foreach ($user as $users)
                                    <tr>
                                        <td>{{$users->id}}</td>
                                        <td>{{$users->email}}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-primary my-2">&nbsp;View&nbsp;</a>
                                            <form action="/admindashboard/deleteUser/{{$users->id}}" method="POST">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"> Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @else

                                <h5>No Records</h5>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection