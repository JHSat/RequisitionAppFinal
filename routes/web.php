<?php

use Illuminate\Support\Facades\Route;

use RealRashid\SweetAlert\Facades\Alert;


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
    Route::get('/admindashboard/users', 'UserController@showUsers')->name('admin.users');
    Route::get('/admindashboard/items', 'ItemController@showItems')->name('admin.itemlist');
    Route::delete('/admindashboard/deleteUser/{id}', 'UserController@deleteUser');
    Route::post('/admindashboard/addItem', 'ItemController@insertItem');
    Route::delete('/admindashboard/deleteItem/{id}', 'ItemController@deleteItem');
    Route::get('/admindashboard/editItem/{id}', 'ItemController@editItem');
    Route::put('/admindashboard/updateItem/{id}', 'ItemController@updateItem');
    Route::post('/admindashboard/uploadPhoto', 'UserController@uploadPhoto');
});

Route::group(['middleware' => ['auth','user']], function () {
   Route::get('/userdashboard', function () {
        return view('user.userdashboard');   
   });
   Route::post('/userdashboard/uploadPhoto', 'UserController@uploadPhoto');
   Route::get('/userdashboard/myprofile', 'UserController@showUserProfile');
});


Route::get('/security', 'UserController@checkIfAuth');

