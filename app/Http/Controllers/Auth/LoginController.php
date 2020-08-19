<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if(Auth::user()->usertype == 'admin'){
            $user_name = Auth::user()->name;
            // dd(usertype);
            toast('Welcome admin, '.$user_name.'','success')->position('top')->width('450px');
            return '/admindashboard';
        }
        else{
            $user_name = Auth::user()->name;
            toast('Welcome '.$user_name.'','success')->position('top')->width('450px');
            return '/userdashboard';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
