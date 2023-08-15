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
    //show all ticket
    public function showTickets()
    {
        $tickets = Ticket::orderBy('id','desc')->paginate(10);

        return view('admin.show-tickets', compact('tickets'));
    }
    //open a ticket
    public function openTicket($ticketId)
    {
        $users = User::where('role', 1)->get();
        $ticket = Ticket::find($ticketId);
        $messages = Message::where('ticket_id', $ticketId)->get();
        $images = Images::where('ticket_id', $ticketId)->get();
            if($ticket->flag == false){
                $ticket->assignto = auth()->user()->id;
                $ticket->status = 1;
                $ticket->save();
            }

        return view('admin.open-ticket', compact('ticket', 'messages', 'users','images'));
    }
    //status and assigned to change
    public function status(Request $rqst, Ticket $ticket)
    {
        if($rqst->status == 0){
            $ticket->assignto = null;
            $ticket->status = $rqst->status;
            $ticket->flag = false;
            $ticket->update();
            return redirect('show-tickets');
        }
        else{
            $ticket->assignto = $rqst->assignto;
            $ticket->status = $rqst->status;
            $ticket->flag = true;
            $ticket->update();
            return redirect('show-tickets');
        }
    }


    //searching
    public function search(Request $request){
        $search = $request->input('search');
        $tickets = Ticket::join('users', 'tickets.assignto', '=', 'users.id')
                    ->where('users.email', 'LIKE', '%' . $search . '%')
                    ->select('tickets.*')
                    ->orderByDesc('created_at')
                    ->paginate(10);

    return view('admin.search-tickets', compact('tickets'));
    }

}
