<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MSRO') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
    <script src="{{asset('js/sweetalert2@9.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    {{-- <script src="{{asset('js/dynamicfields.js')}}"></script> --}}
    {{-- <script src="{{asset('js/fontawesome.min.js')}}"></script> --}}
    <script src="{{asset('js/sample.js')}}"></script>


    {{-- select2 --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,300;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/own.css')}}">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        .active{
            color: #3792cb !important;
        }
        .nopadding{
            padding: 0 !important;
            margin: 0 !important;
        }
        td{
            vertical-align:middle !important;
        }
        .vertalign{
            vertical-align:middle !important;
        }
        a{
            text-decoration: none !important;
        }
    </style>
</head>
<body style="background-color: #D3D3D3;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/security') }}">
                    {{ config('app.name', 'MSRO') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        

                        @if (Auth::user()->position == 'employee')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Notifications <span class="badge badge-danger" id="count_notif">{{count($notifs)}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" aria-labelledby="navbarDropdown2" style="min-width: 30rem">
                                <div class="py-2 text-center">
                                    <span id="forNotif_count"></span>
                                </div>
                                
                                @foreach ($notifs as $notif)
                                    <div class="notif_container">
                                        <div class="notif_wrapper">
                                            <div class="div_img">
                                                <img class="rounded-circle" src="{{asset('./storage/images/check.png')}}" alt="" width="50">
                                            </div>
                                            <div class="px">
                                                <!-- <h3 class="notif_content">New Notif</h3> -->
                                                <p class="notif_content">{{$notif->description}}</p>
                                                <small>Request ID: <a href="/userdashboard/viewRequest/{{$notif->req_id}}">{{$notif->req_id}}</a></small>
                                            </div>
                                            <div class="btn_middle" style="margin-left: auto;">
                                                <button class="btnDismiss btn btn-danger btn-sm" type="submit">Dismiss</button>
                                            </div>
                                        </div>
                                    </div>      
                                @endforeach
                            </div>  
                        </li>
                        @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>  
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <div id="loader">
            <img src="{{asset('storage/images/loader.gif')}}" alt="">
        </div> --}}
        <main>
            @yield('content')
        </main>
    </div>
    @include('sweetalert::alert')
</body>
</html>
