<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Message;
use App\Models\Images;
use Carbon\Carbon;

class TicketController extends Controller
{

    /**
     * Show list of ticket
     *
     * @return Array of ticket
     */
    public function showTickets()
    {
        $tickets = Ticket::orderBy('id', 'desc')->paginate(10);
        $messages = Message::all();

        return view('admin.show-tickets', compact('tickets', 'messages'));
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
        $ticket   = Ticket::findOrfail($ticketId);
        $users    = User::where('role', 1)->get();
        $messages = Message::orderBy('created_at', 'desc')->where('ticket_id', $ticketId)->get();
        $images   = Images::where('ticket_id', $ticketId)->get();


        if ($ticket->flag == false) {

            $ticket->assignto = auth()->user()->id;
            $ticket->status = 1;
            $ticket->save();
        }

        $message = Message::where('ticket_id', $ticketId)->latest()->first();

        if ($message) {

            $message->admin_view = 2;
            $message->save();
        }


        return view('admin.open-ticket', compact('ticket', 'messages', 'users', 'images'));
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

        if (!is_null($ticket->assignto) && $ticket->assignto != $rqst->assignto) {
            return $this->reassignedTicket($rqst, $ticket);
        } else {

            if ($rqst->status == 0) {
                $ticket->assignto = null;
                $ticket->status = $rqst->status;
                $ticket->flag = false;
                $ticket->update();
            } else {
                $ticket->assignto = $rqst->assignto;
                $ticket->status = $rqst->status;
                $ticket->flag = true;
                $ticket->update();
            }

            return redirect()->route('open.ticket', ['ticketId' => $ticket->id]);
        }
    }

    /**
     * Reassigned ticket to admin
     */
    protected function reassignedTicket($request, $ticket)
    {
        $ticket->assignto = $request->assignto;
        $ticket->status = $request->status;
        $ticket->flag = true;
        $ticket->reassigned = $request->assignto;
        $ticket->reassigned_time = Carbon::now();
        $ticket->update();
        return redirect()->route('show.tickets');
    }

    /**
     * Search ticket by email
     *
     *  @param Illuminate\Http\Request $request
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $tickets = Ticket::join('users', 'tickets.assignto', '=', 'users.id')
            ->where('users.email', 'LIKE', '%' . $search . '%')
            ->select('tickets.*')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.search-tickets', compact('tickets'));
    }

    /**
     * Show upcomming ticket into admin sidebar
     */
    public function listofTicket()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        return $tickets;
    }
}
