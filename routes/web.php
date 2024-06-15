<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\check_user;
use App\Http\Middleware\check_admin;


Route::get('/', function () {
    return view('index');
});

Route::post('/CheckLogin',[LoginController::class,'Login'])->name('checklogin');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


// admin
Route::middleware([check_admin::class])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
});


// user
Route::middleware([check_user::class])->group(function(){
    Route::get('/user',[UserController::class,'index'])->name('user');
    Route::post('/user/showdata',[UserController::class,'show'])->name('user.show');
    Route::post('/user/insert',[UserController::class,'insert'])->name('user.insert');
    Route::post('/user/delete',[UserController::class,'delete'])->name('user.delete');
});






