<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTicketRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function index(){
    return view('user.dashboard');
   }
   public function welcome(){
    return view('welcome');
   }

}
