@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-2">
        <a href="/admindashboard/requests" class="btn btn-primary">← Back</a>
    </div>
    <div class="py-3 px-3 my-4 bg-white shadow">
        <h5>Request Information</h5>
        <hr>
        <div class="row">
            <div class="col">
                <div class="my-1">
                    <span class="text-secondary">Requestee: </span><small>{{$user->name}}</small>   
                </div>
                <div class="my-1">
                    <span class="text-secondary">Request ID: </span><small>{{$req->req_id}}</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Transaction Code: </span><small>{{$req->transac_code}}</small>
                </div>
                
                <div class="my-1">
                    <span class="text-secondary">Request Date: </span><small>{{$req->requestedDate}}</small>
                </div>
                <div class="my-1 mb-4">
                    <span class="text-secondary">Status: </span><small>{{$req->status}}</small>
                </div>
            </div>
            <div class="col">
                @if ($req->status == 'O')
                    @if (Auth::user()->position == 'supervisor')
                        <button type="submit" class="btnAuthorize btn btn-success float-right" data-id="{{$req->req_id}}">Authorize</button>
                    @else
                        <div class="float-right">
                            <small class="text-warning">Waiting for supervisor's authorization</small>
                        </div>
                    @endif
                @elseif($req->status == 'A')
                    @if (Auth::user()->position == 'supervisor')
                        <div class="float-right">
                            <small class="text-success">You already authorize this request,</small><br>
                            <small class="text-success">waiting for manager's confirmation</small>
                        </div>
                    @else
                        <button class="btn btn-success float-right">Confirm</button>
                    @endif
                @elseif($req->status == 'C' or $req->status == 'P')
                    <div class="float-right"></div>
                @endif
                <div class="my-1">
                    @if (isset($author))
                        <span class="text-secondary">Authorized by: </span><small id="authorizedBy"> {{$author->name}}</small>
                        
                    @else
                        <span class="text-secondary">Authorized by: </span><small id="authorizedBy">---</small>
                        
                    @endif
                </div>
                <div class="my-1">
                    @if (isset($req->authorizedDate))
                        <span class="text-secondary">Authorized Date: </span><small id="authDate"> {{$req->authorizedDate}}</small> 
                    @else
                        <span class="text-secondary">Authorized Date: </span><small id="authDate">---</small> 
                    @endif
                </div>
                <div class="my-1">
                    <span class="text-secondary">Confirmed Date: </span><small class="text-danger">asd</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Confirmed by: </span><small class="text-danger">asd</small>
                </div>
                <div class="my-1">
                    <span class="text-secondary">Processed Date: </span><small class="text-danger">asd</small>
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
                    @foreach ($items as $item)
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