<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function showTickets(){
        $tickets = Ticket::all();
        return view('admin.show-tickets',compact('tickets'));
    }
    public function openTicket($ticketId){
        $ticket = Ticket::find($ticketId);
        return view('admin.open-ticket',compact('ticket'));
    }
}
