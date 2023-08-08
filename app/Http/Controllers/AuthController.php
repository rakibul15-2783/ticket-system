<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function loginpost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       $credentials = $request->only('email', 'password');


       if(Auth::attempt($credentials)) {
        if(auth()->user()->role == 2){
            return redirect()->route('admin.dashboard');
        }

           return redirect()->route('user.dashboard');
       }

       return back();

    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
