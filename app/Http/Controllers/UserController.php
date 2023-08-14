<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Images;

class UserController extends Controller
{
   public function index(){
    return view('user.dashboard');
   }
   public function ticket(){
    $user = auth()->user()->id;
    $ticket = Ticket::where('user_id', $user)->get();
    return view('user.create-ticket',compact('ticket'));
   }
   public function showTicket(){
    $user = auth()->user()->id;
    $tickets = Ticket::where('user_id', $user)->paginate(5);
    return view('user.show-ticket',compact('tickets'));
   }
   public function storeTicket(Request $request)
   {
    $user_id = auth()->user()->id;

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'des' => 'required|string',
    ]);

    $ticket = new Ticket();
    $ticket->user_id = $user_id;
    $ticket->name = $validatedData['name'];
    $ticket->email = $validatedData['email'];
    $ticket->subject = $validatedData['subject'];
    $ticket->category = $validatedData['category'];
    $ticket->des = $validatedData['des'];
    $ticket->save();

    return redirect('show-ticket')->with('success', 'Ticket Created Successfully');
    }

   public function viewTicket($ticketId){
    $ticket = Ticket::find($ticketId);
    $messages = Message::where('ticket_id', $ticketId)->get();
    $images = Images::where('ticket_id', $ticketId)->get();
    return view('user.view-ticket',compact('ticket','messages','images'));
   }
   //message from user
   public function message(Request $request, $ticketId)
    {
        dd($request->all());
        // $message = new Message();
        // $message->user_id = auth()->user()->id;
        // $message->ticket_id = $ticketId;
        // $message->message = $request->message;
        // $message->save();
        return back();
    }
}
