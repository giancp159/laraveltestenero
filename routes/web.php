<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('register/request', 'Auth\RegisterController@requestInvitation')->name('requestInvitation');
Route::post('invitations', 'InvitationsController@store')->middleware('guest')->name('storeInvitation');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'invitations'
], function() {
    Route::get('/', 'InvitationsController@index')->name('showInvitations');
});

Route::get('register', 'Auth\RegisterController@showRegistrationForm')
  ->name('register')
  ->middleware('hasInvitation');