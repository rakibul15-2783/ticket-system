<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
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
Route::middleware('guest')->group(function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login-post',[AuthController::class,'loginpost'])->name('login.post');
});
//for user
Route::middleware('auth')->group(function(){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/user-dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('/create-ticket',[UserController::class,'ticket'])->name('ticket');
    Route::get('/show-ticket',[UserController::class,'showTicket'])->name('show.ticket');
    Route::post('/store-ticket',[UserController::class,'storeTicket'])->name('store.ticket');

});
//for admin
Route::middleware('auth','admin')->group(function(){
    Route::get('/admin-dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/show-tickets',[AdminController::class,'showTickets'])->name('show.tickets');
    Route::get('/open-ticket/{ticketId}',[AdminController::class,'openTicket'])->name('open.ticket');
    Route::post('/message-post',[AdminController::class,'message'])->name('message.post');
    Route::post('/status-post/{ticketId}',[AdminController::class,'status'])->name('status.post');
});





Route::get('/', function () {
    return view('welcome');
});


