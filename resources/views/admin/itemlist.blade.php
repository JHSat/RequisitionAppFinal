@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add an Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formAddItem">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Unit</label>
                    <input type="text" class="form-control" name="unit" id="unit" required>
                </div>
                {{-- <div class="form-group">
                    <label>Item Code</label>
                    <input type="text" class="form-control" name="itemCode" required>
                </div> --}}
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnAddItem" class="btn btn-primary">Save Item</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- end modal --}}


{{-- modal details  --}}
<div class="modal fade" id="modalItemDetails" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <span>Item ID: </span> <span id="item_id" class="text-secondary"></span><br><br>
              <span>Item Code: </span> <span id="itemCode" class="text-secondary"></span><br><br>
              <span>Unit: </span> <span id="unitItem" class="text-secondary"></span><br><br>
              {{-- <span>Unit: </span> <span id="unit" class="text-secondary"></span><br><br> --}}
              <span>Item Description: </span> <br><br> <span id="unitDescription" class="text-secondary"></span><br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- end modal  --}}


{{-- modal edit / update --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <form id="formEditItem">

                @csrf
                <input type="text" class="form-control" id="item_id" hidden>
                <input type="text" class="form-control" id="itemCode" hidden>
                <div class="form-group">
                    <label for="">Unit</label>
                    <input type="text" class="form-control" id="editUnit">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="editDescription" cols="30" rows="10" class="form-control"></textarea>
                </div>
              
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btnUpdateItem">Save Changes</button>
        </form>
        </div>
      </div>
    </div>
</div>

{{-- end modal  --}}


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
            <div class="card ml-auto mr-auto my-4">
                <div class="card-header">
                    <div class="row nopadding">
                        <div class="col nopadding">
                            <h5 class="pt-2">Item List</h5>
                        </div>
                        <div class="col nopadding text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Item Code</td>
                                <td>Unit</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //show DataTables
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.items') }}"
            },
            columns: [
                { data: 'item_id', name: 'item_id'},
                { data: 'itemCode', name: 'itemCode'},
                { data: 'unit', name: 'unit'},
                { data: 'action', name: 'action'}
            ]
        });
    });
</script>
@include('sweetalert::alert')
@endsection