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

/*Route::get('/', function () {
    $body_class = 'sidebar-mini';
    $wrapper_class = 'wrapper';
    return view('welcome', compact('body_class', 'wrapper_class'));
});*/
Route::get('/',[App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'], function(){
    Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
    });
    Route::group(['prefix'=>'merchant','middleware'=>'merchant'],function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'merchant'])->name('merchant');
    });
    Route::group(['prefix'=>'driver','middleware'=>'driver'],function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'driver'])->name('driver');
    });
});
// Google login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);