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
    $ticket = Ticket::where('user_id', $user)->get();
    return view('user.show-ticket',compact('ticket'));
   }
   public function storeTicket(Request $rqst){
    $user_id = auth()->user()->id;
    $tickets = new Ticket();
    $tickets->user_id = $user_id;
    $tickets->name = $rqst->name;
    $tickets->email = $rqst->email;
    $tickets->subject = $rqst->subject;
    $tickets->category = $rqst->category;
    $tickets->des = $rqst->des;
    $tickets->save();
    return redirect('show-ticket');
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
