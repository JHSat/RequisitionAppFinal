@extends('layouts.app')

@section('content')

    <div class="container py-3">
        <a href="/admindashboard/items" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        <div class="card m-auto w-75">
            <div class="card-header">
                <h5>Edit Item Information</h5>
            </div>
            <div class="card-body">
                <form class="form-group" action="/admindashboard/updateItem/{{$item->item_id}}" method="post">
                    {{ csrf_field() }}
                    @method('put')
                    <label for="">Unit</label>
                    <input class="form-control" type="text" name="unit" value="{{$item->unit}}"><br>
                    <label for="">Item Code</label>
                    <input class="form-control" type="text" name="itemCode" value="{{$item->itemCode}}"><br>
                    <label for="">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="8">{{$item->description}}</textarea>

                    <br>

                    <button type="submit" class="btn btn-primary float-right">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>
                </form>
            </div>
        </div>
    </div>

@endsection