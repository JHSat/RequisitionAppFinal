<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Items;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class UserController extends Controller
{

    public function userCount(){
        $userCount = User::where('usertype', '=', 'user')->get();
        $itemCount = Items::all();
        return view('admin.admindashboard')->with('userCount', $userCount)->with('itemCount', $itemCount);
    }
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

    public function checkIfAuth(){
        if(Auth::user()){
            if(Auth::user()->usertype == 'admin'){
                $userCount = User::where('usertype', '=', 'user')->get();
                $itemCount = Items::all();
                return view('admin.admindashboard')->with('userCount', $userCount)->with('itemCount', $itemCount);
            }
            else{
                return view('user.userdashboard');
            }
        }
        else{
            return view('welcome');
        }
    }

    public function uploadPhoto(Request $request){
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();

            $request->image->storeAs('images', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);
            // if(auth()->user()->avatar){
            //     Storage::delete('/public/images/'.auth()->user()->avatar);
            // }
            // $request->image->storeAs('images', $filename, 'public');
            // auth()->user()->update(['avatar' => $filename]);
        }
        return redirect()->back();
    }
}
