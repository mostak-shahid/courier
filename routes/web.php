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

        Route::get('/merchants', [App\Http\Controllers\userController::class, 'merchants'])->name('admin.merchants');
        Route::get('/merchants/register', [App\Http\Controllers\userController::class, 'merchantsRegister'])->name('admin.merchants.register');
        Route::post('/merchants/store', [App\Http\Controllers\userController::class, 'merchantsStore'])->name('admin.merchants.store');
        Route::get('/merchants/{id}/edit', [App\Http\Controllers\userController::class, 'merchantsEdit'])->name('admin.merchants.edit');
        Route::put('/merchants/{id}', [App\Http\Controllers\userController::class, 'merchantsUpdate'])->name('admin.merchants.update');
        Route::delete('/merchants/{id}', [App\Http\Controllers\userController::class, 'merchantsDestroy'])->name('admin.merchants.destroy');
        Route::get('/merchants/changePassword/{id}', [App\Http\Controllers\userController::class, 'merchantsChangePassword'])->name('admin.merchants.changepassword');
        Route::post('/merchants/updatePassword/{id}', [App\Http\Controllers\userController::class, 'merchantsUpdatePassword'])->name('admin.merchants.updatepassword');
        Route::get('/merchants/{id}/active', [App\Http\Controllers\userController::class, 'merchantsActive'])->name('admin.merchants.active');
        Route::get('/merchants/{id}/deactive', [App\Http\Controllers\userController::class, 'merchantsDeactive'])->name('admin.merchants.deactive');

        Route::get('/drivers', [App\Http\Controllers\userController::class, 'drivers'])->name('admin.drivers');
        Route::get('/drivers/register', [App\Http\Controllers\userController::class, 'driversRegister'])->name('admin.drivers.register');
//        Route::post('/drivers/store', [App\Http\Controllers\userController::class, 'driversStore'])->name('admin.drivers.store');
//        Route::get('/drivers/{id}/edit', [App\Http\Controllers\userController::class, 'driversEdit'])->name('admin.drivers.edit');
//        Route::put('/drivers/{id}', [App\Http\Controllers\userController::class, 'driversUpdate'])->name('admin.drivers.update');
//        Route::delete('/drivers/{id}', [App\Http\Controllers\userController::class, 'driversDestroy'])->name('admin.drivers.destroy');
//        Route::get('/drivers/changePassword/{id}', [App\Http\Controllers\userController::class, 'driversChangePassword'])->name('admin.drivers.changepassword');
//        Route::post('/drivers/updatePassword/{id}', [App\Http\Controllers\userController::class, 'driversUpdatePassword'])->name('admin.drivers.updatepassword');
//        Route::get('/drivers/{id}/active', [App\Http\Controllers\userController::class, 'driversActive'])->name('admin.drivers.active');
//        Route::get('/drivers/{id}/deactive', [App\Http\Controllers\userController::class, 'driversDeactive'])->name('admin.drivers.deactive');
    });
    Route::group(['prefix'=>'merchant','middleware'=>'merchant'],function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'merchant'])->name('merchant');
    });
    Route::group(['prefix'=>'driver','middleware'=>'driver'],function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'driver'])->name('driver');
    });
});

Route::get('/image/{url}/{width}/{height?}', function($url,$width,$height=null){
    if (is_numeric($url)) {
        if (preg_match('/image/i', App\Models\Media::find($url)->type)) {
            $url = App\Models\Media::find($url)->url;
        }else {
            $url = 'placeholder.png';
        }
    }

    if ($width && $height) {
        $img = Image::make($url)->fit($width, $height);
    } else {
        $img = Image::make($url)->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });
    }
    $arr = explode('.',$url);
    if (is_array($arr)) {
        $ext = end($arr);
        return $img->response($ext);
    }
    return $img->response('jpg');
    // $img->save('bar.jpg', 60);
})->name('image');

// Google login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);