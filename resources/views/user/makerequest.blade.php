@extends('layouts.app')

@section('content')

{{-- modal  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/uploadPhoto" enctype="multipart/form-data">
                @method('post')
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
    <div class="col-2 bg-white nopadding" style="height: 1000px;">
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
                <a href="/userdashboard" class="text-decoration-none text-secondary active">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/userdashboard/myprofile" class="text-decoration-none text-secondary">
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
            <div class="card">
                <div class="card-header">
                    Requisition Form
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="py-3">
                            <small>Date: </small><small>10/01/2020</small>
                        </div>
                        <div class="form-group">
                            <label for="">Requestee:</label>
                            <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                        </div>
                        <div class="py-4">
                            <h5>Items</h5>
                            <hr>
                            <form name="addRequest" id="addRequest">
                                
                                @csrf
                                <input type="text" name="requestee" id="requestee" value="{{Auth::user()->id}}" hidden>
                            <div class="container1">
                                <button class="add_form_field btn btn-success my-1">Add New Field &nbsp; 
                                  <span style="font-size:16px; font-weight:bold;">+ </span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnInsertRequest" class="btn btn-primary">Save Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
