@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-2">
        <a href="/userdashboard" class="btn btn-primary">← Back</a>
    </div>
    <div class="py-3 px-3 my-4 bg-white shadow">
        <h5>Requisition Information</h5>
        <hr>
        <div class="row">
            <div class="col">
                <div class="my-1">
                    <span class="text-secondary">Request ID: </span><small>{{$request->req_id}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Transaction Code: </span><small>{{$request->transac_code}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Requestee: </span>
                    {{-- @foreach ($user as $use) --}}
                        <small>
                            {{$user->name}}
                        </small>   
                    {{-- @endforeach --}}
                    
                </div>
                <div class="my-1">
                    <span class="text-secondary">Request Date: </span><small>{{$request->requestedDate}}</small>
                </div>
                <div class="my-1 mb-4">
                    <span class="text-secondary">Status: </span><small class="text-danger">{{$request->status}}</small>
                </div>
            </div>
            <div class="col text-right">
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
        <h5>Items</h5>
        <hr>
        <div class="container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mouse</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Mouse</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Mouse</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Mouse</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection