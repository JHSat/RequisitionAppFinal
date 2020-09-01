<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Items;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function userCount(){
        $userCount = User::where('usertype', '=', 'user')->get();
        $itemCount = Items::all();
        return view('admin.admindashboard')->with('userCount', $userCount)->with('itemCount', $itemCount);
    }
    public function showUsers(){

        return view('admin.userlist');
    }

    public function getUsers(){
        $data = User::where('usertype', '=', 'user');
        return Datatables::of($data)
        ->addColumn('action', function($row){
            // $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a> ';
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btnViewUserDetails btn btn-primary btn-sm">View Details</a> ';

            return $btn;
        })
        ->make(true);
    }

    public function userDetails($id){
        $data = User::find($id);
        return response()->json($data);
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

    public function showUserProfile(){
        
        $user = Auth::user();
        if(session('success_message')){
            toast(session('success_message'),'success')->position('top')->width('450px');
        }
        return view('user.userprofile')->with('user', $user);
    }

    public function updateProfile(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email,'.$id
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('myprofile')->withSuccessMessage('Successfully updated!');
    }
}
