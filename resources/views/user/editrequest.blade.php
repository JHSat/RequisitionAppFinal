@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-2">
        <a href="/userdashboard/viewRequest/{{$req->req_id}}" class="btn btn-primary">← Back</a>
        </div>
        <div class="card my-4">
            <div class="card-header">
                Edit Request
            </div>
            <div class="card-body">
                <div>
                    <h5>Requested Items</h5>
                    <hr>
                </div>
                <table class="table table-striped" id="myTableEditItems">
                    <thead>
                        <th>Item ID</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </thead>
                </table>

                <div class="my-3">
                    <small class="text-secondary">To add additional items,</small><br>
                    <small class="text-secondary">Please click</small>
                    <small class="text-success">add item</small>  
                </div>
                <div>
                    <input type="text" value="{{$req->transac_code}}" id="transac_code" hidden>
                </div>
                <form id="editItemForm">
                    <div class="container2">
                        <button class="add_form btn btn-success mb-2 btn-sm">Add New Field &nbsp; 
                            <span style="font-size:16px; font-weight:bold;">+ </span>
                        </button>
                        <div>
                            <input type="text" value="{{$req->transac_code}}" name="transac_code" hidden>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <select name="item[]" class="selItem form-control"></select>
                            </div>
                            <div class="col">
                                <input class="form-control" type="number" placeholder="quantity" name="quantity[]">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnAddEditItem" class="btn btn-primary">Submit!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
       var url = window.location.pathname;
       var id = url.substring(url.lastIndexOf('/') + 1);

    //    console.log(id)

       $('#myTableEditItems').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '/getEditItems/' + id
            },
            columns: [
                { data: 'item_id', name: 'item_id'},
                { data: 'unit', name: 'unit'},
                { data: 'quantity', name: 'quantity'},
                { data: 'action', name: 'action'}
            ]
        });
    })
</script>
@endsection