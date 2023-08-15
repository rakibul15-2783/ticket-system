<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Message;
use App\Models\Images;

class TicketController extends Controller
{

    /**
     * Show list of ticket
     * 
     * @return Array of ticket
     */
    public function showTickets()
    {
        $tickets = Ticket::orderBy('id','desc')->paginate(10);

        return view('admin.show-tickets', compact('tickets'));
    }

    /**
     * View single ticket
     * 
     * @param int $ticketId
     * 
     * @return View
     */
    public function openTicket($ticketId)
    {
        $users    = User::where('role', 1)->get();
        $ticket   = Ticket::find($ticketId);
        $messages = Message::where('ticket_id', $ticketId)->get();
        $images   = Images::where('ticket_id', $ticketId)->get();
        
        if($ticket->flag == false){
            $ticket->assignto = auth()->user()->id;
            $ticket->status = 1;
            $ticket->save();
        }

        return view('admin.open-ticket', compact('ticket', 'messages', 'users','images'));
    }

    public function listofTicket()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        return $tickets;
    }
}