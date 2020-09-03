@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card w-75">
        <div class="card-header">Sample</div>
        <div class="card-body">
            {{-- <div class="p">
                <button class="btn btn-success float-right mb-5" id="btnSampleAdd">+ Add Field</button>
            </div> --}}
            <div>
                <form id="sampleForm">
                    <div class="container2">
                        <button class="add_form_field btn btn-success my-1">Add New Field &nbsp; 
                          <span style="font-size:16px; font-weight:bold;">+ </span>
                        </button>
                    </div>
                    <button type="submit" id="btnSubmitSample" class="btn btn-primary">Submit!</button>
                </form>
            </div>
        </div>
    </div>
</div>
   

@endsection