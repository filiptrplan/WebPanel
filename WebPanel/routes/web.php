<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Authentication routes
Route::get('login', function(){
    return view('auth.login');
})->name('login');

Route::get('logout', function(){
    Auth::logout();
    return view('auth.login');
});

Route::post('authenticate', 'LoginController@authenticate');


Route::get('/{any}', 'SpaController@index')->where('any', '.*')->middleware('auth');

