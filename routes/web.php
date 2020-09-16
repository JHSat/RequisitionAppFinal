<?php

use Illuminate\Support\Facades\Route;

use RealRashid\SweetAlert\Facades\Alert;
use App\Notification;
// use Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::get('/userdashboard', 'HomeController@index')->name('userdashboard');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/admindashboard','UserController@userCount');
    Route::get('/admindashboard/requests', 'RequestController@requestAdminIndex');
    Route::get('/getAllRequests', 'RequestController@getAllRequests');
    Route::get('/admindashboard/users', 'UserController@showUsers')->name('admin.users');
    Route::get('/admindashboard/items', 'ItemController@showItems')->name('admin.itemlist');
    Route::get('/getItems', 'ItemController@getItems')->name('get.items');
    Route::get('/getItemDetails/{id}', 'ItemController@getItemDetails')->name('get.items.details');
    Route::post('/admindashboard/addItem', 'ItemController@insertItem');
    Route::delete('/deleteItem/{id}', 'ItemController@deleteItem');
    Route::get('/admindashboard/editItem/{id}', 'ItemController@editItem');
    Route::put('/updateItem/{id}', 'ItemController@updateItem');
    Route::post('/admindashboard/uploadPhoto', 'UserController@uploadPhoto');
    Route::get('/admindashboard/getusers', 'UserController@getUsers')->name('get.users');
    Route::get('/userDetails/{id}', 'UserController@userDetails');
    Route::post('/addUser', 'UserController@addUser');
    Route::put('/updateDeptUser/{id}', 'UserController@updateDeptUser');
    Route::get('/admindashboard/viewRequestAdmin/{id}', 'RequestController@viewRequestAdmin');
    Route::put('/authorizeRequest/{id}', 'RequestController@authorizeRequest');
    Route::put('/confirmRequest/{id}', 'RequestController@confirmRequest');


});

Route::group(['middleware' => ['auth','user']], function () {
   Route::get('/userdashboard', 'UserController@userIndex');
   Route::post('/userdashboard/uploadPhoto', 'UserController@uploadPhoto');
   Route::get('/userdashboard/myprofile', 'UserController@showUserProfile')->name('myprofile');
   Route::post('/userdashboard/updateProfile/{id}', 'UserController@updateProfile');
   Route::post('/uploadPhoto', 'UserController@uploadPhoto');
   Route::get('/userdashboard/makerequest', 'RequestController@indexmakerequest');
   Route::get('/getAllItems', 'RequestController@getAllItems');
   Route::post('/insertRequest', 'RequestController@insertRequest');
   Route::get('/sample', 'RequestController@sampleindex');
   Route::post('/select2item', 'RequestController@select2Item');
   Route::get('/userdashboard/viewRequest/{id}', 'RequestController@requestIndex');
   Route::delete('/deleteRequest/{id}', 'RequestController@deleteRequest');
   Route::get('/editRequest/{id}', 'RequestController@editRequest');
   Route::get('/getEditItems/{id}', 'RequestController@getEditItems');
   Route::delete('/removeItem', 'RequestController@removeItem');
   Route::post('/updateRequestItem', 'RequestController@updateRequestItem');
   Route::put('/setAsProcessed/{id}', 'RequestController@setAsProcessed');

   View::composer('layouts.app', function($view){

    if (Auth::user()) {
        $notifs = Notification::where('user_notif', '=', Auth::user()->id)->where('status', '=', 'unread')->get();
        $view->with('notifs', $notifs);
    } else {
        return $view;
    }
    
        
        // dd($notifs);
   });
});

Route::get('/security', 'UserController@checkIfAuth');

