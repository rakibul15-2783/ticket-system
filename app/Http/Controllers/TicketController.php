<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Images;

class TicketController extends Controller
{
    public function showTicket(){
        $user = auth()->user()->id;
        $tickets = Ticket::where('user_id', $user)->orderByDesc('created_at')->paginate(10);
        return view('user.show-ticket',compact('tickets'));
       }

       public function ticket(){
        $user = auth()->user()->id;
        $ticket = Ticket::where('user_id', $user)->get();
        return view('user.create-ticket',compact('ticket'));
       }

       public function storeTicket(CreateTicketRequest $request)
       {
        $user_id = auth()->user()->id;

        $ticket = new Ticket();
        $ticket->user_id = $user_id;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->subject = $request->subject;
        $ticket->category = $request->category;
        $ticket->des = $request->des;
        $ticket->save();

        return redirect('show-ticket')->with('success', 'Ticket Created Successfully');
        }

       public function viewTicket($ticketId){
        $ticket = Ticket::find($ticketId);
        $messages = Message::where('ticket_id', $ticketId)->get();
        $images = Images::where('ticket_id', $ticketId)->get();
        return view('user.view-ticket',compact('ticket','messages','images'));
       }
}
