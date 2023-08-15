<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Images;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

}
