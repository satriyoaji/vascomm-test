<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/', 'HomeController@landingPage')->name('landing-page');
});

Auth::routes(['verify' => true]);
Route::get('/password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::name('user.')->prefix('user')->group(function () {
        Route::post('/change-password', 'UserController@changePassword')->name('change-password');
        Route::post('/change-image', 'UserController@uploadImage')->name('change-image');
        Route::post('/editprofile/{id}', 'UserController@editprofile')->name('editprofile');
        Route::get('/select', 'UserController@select')->name('select');

    });
    Route::resource('/user', 'UserController');

});
