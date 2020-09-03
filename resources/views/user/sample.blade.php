@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card w-75 mx-auto my-5">
        <div class="card-header">Sample</div>
        <div class="card-body">
            {{-- <div class="p">
                <button class="btn btn-success float-right mb-5" id="btnSampleAdd">+ Add Field</button>
            </div> --}}
            <div>
                <form id="sampleForm">
                    <div class="container2">
                        <button class="add_form btn btn-success mb-4">Add New Field &nbsp; 
                          <span style="font-size:16px; font-weight:bold;">+ </span>
                        </button>

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
                        <button type="submit" id="btnSubmitSample" class="btn btn-primary">Submit!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
   

@endsection