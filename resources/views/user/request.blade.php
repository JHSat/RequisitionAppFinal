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
                    <span class="text-secondary">Requestee: </span><small>{{$user->name}}</small>   
                </div>
                <div class="my-1">
                    <span class="text-secondary">Request Date: </span><small>{{$request->requestedDate}}</small>
                </div>
                <div class="my-1 mb-4">
                    <span class="text-secondary">Status: </span><small class="text-danger">{{$request->status}}</small>
                </div>
            </div>
            <div class="col">
                <a href="/editRequest/{{$request->req_id}}" class="float-right btn btn-primary mx-1" type="submit">Edit</a>
            <button class="float-right btn btn-danger mx-1" type="submit" id="btnDeleteRequest" data-id="{{$request->req_id}}">Delete</button>
                <div class="my-1">
                    <span class="text-secondary">Authorized by: </span><small class="text-danger">{{$request->authorizedBy}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Authorized Date: </span><small class="text-danger">{{$request->authorizedDate}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Confirmed Date: </span><small class="text-danger">{{$request->confirmedDate}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Confirmed by: </span><small class="text-danger">{{$request->confirmedBy}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Processed Date: </span><small class="text-danger">{{$request->processedDate}}</small>
                </div>
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
                    @foreach ($data_items as $item)
                        <tr>
                            <td>{{$item->item_id}}</td>
                            <td>{{$item->unit}}</td>
                            <td>{{$item->quantity}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection