<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    //show all ticket
    public function showTickets(){
        $tickets = Ticket::all();
        return view('admin.show-tickets',compact('tickets'));
    }
    //open a ticket
    public function openTicket($ticketId){
        $users = User::all();
        $ticket = Ticket::find($ticketId);
        $messages = Message::where('ticket_id', $ticketId)->get();
        return view('admin.open-ticket',compact('ticket','messages','users'));
    }
    public function status(Request $rqst, $ticketId){
        $ticket = Ticket::find($ticketId);

        if ($ticket) {
            $ticket->assignto = $rqst->assignto;
            $ticket->status = $rqst->status;
            $ticket->save();
        }
        return back();

    }
}
