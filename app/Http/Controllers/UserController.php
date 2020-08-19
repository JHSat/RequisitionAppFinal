<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function showUsers(){
        $user = User::where('usertype', '=', 'user')->get();
        // dd($user);
        if(session('success_message')){
            toast(session('success_message'),'success')->position('top')->width('450px');
        }
        return view('admin.userlist')->with('user', $user);
    }

    public function deleteUser($id){
            $user = User::find($id);
            $user->delete();
            return redirect()->route('admin.users')->withSuccessMessage('Successfully Deleted!');
    }
}
