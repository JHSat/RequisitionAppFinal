<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function indexmakerequest(){
        return view('user.makerequest');
    }
}
