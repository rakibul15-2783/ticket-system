<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\View;
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
    Route::get('/',[UserController::class,'welcome'])->name('welcome');
});
//for user
Route::middleware('auth','user')->group(function(){
    Route::get('/user-dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('/create-ticket',[TicketController::class,'ticket'])->name('ticket');
    Route::get('/show-ticket',[TicketController::class,'showTicket'])->name('show.ticket');
    Route::post('/store-ticket',[TicketController::class,'storeTicket'])->name('store.ticket');
    Route::get('/view-ticket/{ticketId}',[TicketController::class,'viewTicket'])->name('view.ticket')->middleware('user.ticket');
    Route::post('/user-message-post/{ticketId}',[MessageController::class,'message'])->name('userMessage.post');

});
//for admin
Route::middleware('auth','admin')->group(function(){
    Route::get('/admin-dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/show-tickets',[AdminTicketController::class,'showTickets'])->name('show.tickets');
    Route::get('/open-ticket/{ticketId}',[AdminTicketController::class,'openTicket'])->name('open.ticket')->middleware('ticket');
    Route::post('/message-post/{ticketId}',[MessageController::class,'message'])->name('message.post');
    Route::post('/status-post/{ticket}',[AdminTicketController::class,'status'])->name('status.post');
    Route::get('/search-tickets',[AdminTicketController::class,'search'])->name('search.tickets');
});


Route::get('/logout',[AuthController::class,'logout'])->name('logout');


