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
        $messages = Message::orderBy('created_at','desc')->where('ticket_id', $ticketId)->get();
        $images   = Images::where('ticket_id', $ticketId)->get();
        
        if($ticket->flag == false){
            $ticket->assignto = auth()->user()->id;
            $ticket->status = 1;
            $ticket->save();
        }

        return view('admin.open-ticket', compact('ticket', 'messages', 'users','images'));
    }

     /**
      * Change status of ticket and assign to Admin
      *
      * @param Illuminate\Http\Request $rqst
      * @param Object of Ticket Model
      *
      * @return RedirectResponse
      *
      */
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

    /**
     * Search ticket by email
     * 
     * @param @param Illuminate\Http\Request $request
     */
    public function search(Request $request){
        $search = $request->input('search');
        $tickets = Ticket::join('users', 'tickets.assignto', '=', 'users.id')
                    ->where('users.email', 'LIKE', '%' . $search . '%')
                    ->select('tickets.*')
                    ->orderByDesc('created_at')
                    ->paginate(10);

         return view('admin.search-tickets', compact('tickets'));
    }

    public function listofTicket()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        return $tickets;
    }
}