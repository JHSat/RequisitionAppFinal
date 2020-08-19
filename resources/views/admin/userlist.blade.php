@extends('layouts.app')

@section('content')

{{-- @if (session('success'))
    <div class="d-none">
        {{session('success')}}
    </div>
@endif --}}

<div class="row nopadding">
    <div class="col-2 bg-light nopadding" style="height: 100vh;">
        <div class="container py-3">
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
        </div>
    </div>
    <div class="col nopadding">
        <div class="container">
            <div class="card ml-auto mr-auto w-75 my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Employees</div>
                        <div class="col"><button class="btn btn-primary btn-sm float-right">Add</button></div>
                    </div>
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