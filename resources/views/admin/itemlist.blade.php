@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add an Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/admindashboard/addItem">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Unit</label>
                    <input type="text" class="form-control" name="unit" required>
                </div>
                <div class="form-group">
                    <label>Item Code</label>
                    <input type="text" class="form-control" name="itemCode" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- end modal --}}

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
                <a href="/admindashboard/users" class="text-decoration-none text-secondary ">
                    <i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Users</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/items" class="text-decoration-none text-secondary active"><i class="fas fa-people-carry"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Items</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container">
            <div class="card ml-auto mr-auto w-75 my-4">
                <div class="card-header">
                    <div class="row nopadding">
                        <div class="col nopadding">
                            <h5 class="pt-2">Item List</h5>
                        </div>
                        <div class="col nopadding text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Unit</td>
                                <td>Item Code</td>
                                <td>Description</td>
                                <td class="text-right">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($item) > 0)
                                @foreach ($item as $items)
                                    <tr>
                                        <td>{{$items->item_id}}</td>
                                        <td>{{$items->unit}}</td>
                                        <td>{{$items->itemCode}}</td>
                                        <td>{{$items->description}}</td>
                                        <td class="text-right">
                                            <a href="/admindashboard/editItem/{{$items->item_id}}" class="btn btn-primary my-2">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                            <form action="/admindashboard/deleteItem/{{$items->item_id}}" method="POST">
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