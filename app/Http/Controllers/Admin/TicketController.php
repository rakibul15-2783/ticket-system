<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function listofTicket()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        return $tickets;
    }
}