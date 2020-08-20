@extends('layouts.app')

@section('content')
<div class="row nopadding">
    <div class="col-2 bg-white nopadding" style="height: 100vh;">
        <div class="container py-3">
            <div class="px-1">
                <a href="/userdashboard" class="text-decoration-none text-secondary active">
                     <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Home</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>My Profile</span>
                </a>
            </div>
            <hr>
            <div class="px-1">
                <a href="" class="text-decoration-none text-secondary"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
            </div>
        </div>
    </div>
    <div class="col nopadding">
        <div class="container py-4">
            <div class="card w-75 m-auto">
                <div class="card-header">
                    Recent Posts
                </div>
                <div class="card-body">
                    <a href="">
                        <div class="container border-bottom pt-3">
                            <h5>Request 1</h5>
                            <div class="row nopadding">
                                <div class="col nopadding"><pre>This is a request</pre></div>
                                <div class="col nopadding text-right"><pre class="text-muted">Requested on: 08/11/2020</pre></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <h5>Welcome admin!</h5>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
