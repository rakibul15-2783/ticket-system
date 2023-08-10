<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ticket;

class ticketAccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ticketId = $request->route('ticketId');
        $ticket = Ticket::find($ticketId);
        if($request->user()->id == $ticket->assignto || $ticket->assignto == null) {
            return $next($request);
        }
        return back();
    }
}
