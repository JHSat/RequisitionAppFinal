@extends('layouts.app')

@section('content')
{{-- modal display --}}
<div class="modal fade" id="userModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <span>ID Number: </span> <span id="id"></span><br><br>
                    <span>Name: </span> <span id="name"></span><br><br>
                    <span>Email: </span> <span id="email"></span><br><br>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- modal end  --}}



{{-- modal  --}}
<div class="modal fade" id="addUserModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="Default Name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="default@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Assigned to:</label>
                            <select name="department" id="department" class="form-control" required>
                                <option value="">...</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Position:</label>
                            <select name="emPosition" id="emPosition" class="form-control" required>
                                <option value="">...</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="employee">Regular Employee</option>
                            </select>
                        </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="btnAddUser">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- modal end  --}}




<div class="row nopadding">
    <div class="col-md-2 bg-light nopadding" style="height: 100vh;">
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
                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" alt="..." class="rounded-circle img-fluid" width="120"><br>
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
                <a href="/admindashboard/users" class="text-decoration-none text-secondary active">
                    <i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Users</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
            <hr>
            <div class="px-1">
                <a href="/admindashboard/items" class="text-decoration-none text-secondary"><i class="fas fa-people-carry"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Items</span></a>
            </div>
        </div>
    </div>
    <div class="col-md nopadding">
        <div class="container">
            @if (Auth::user()->department == 0)
            <div class="card mt-3" style="max-width: 18rem;">
                <div class="card-header">Select</div>
                <div class="card-body text-dark">
                  <p class="card-text">Please select a department to view employees</p>
                    <form>
                        <label for=""><span class="text-success"> Select a department: </span></label>
                        <select name="" id="" class="form-control">
                            <option value="">...</option>
                            @foreach ($departments as $department)
                                <option value="">{{$department->department_name}}</option>
                            @endforeach
                        </select>
                        <div class="py-3">
                            <button class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
              </div>
            @else
            <div class="card ml-auto mr-auto my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h5 class="py-3">Employees</h5>
                        </div>
                        <div class="col">
                            <button type="button" data-target="#addUserModal" class="btn btn-primary float-right" data-toggle="modal">Add +</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                    </table>    
                </div>
            </div>
            @endif
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
                url: "{{ route('get.users') }}"
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'action', name: 'action'}
            ]
        });
    });
</script>
@include('sweetalert::alert')
@endsection