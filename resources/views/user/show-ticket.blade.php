@extends('user.includes.master')
@section('main-content')

<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ My Tickets</p>
        </div>
    </div>
</div><br>
<div class="container">
    <strong>Your All Tickets</strong><br><br>
    <div class="card shadow">
    @if ($ticket->isEmpty())
    <h4 class=" text-center m-3">NO TICKET FOUND.</h4>
    @else
    <ul class="list-group">
        <li class="list-group-item list-group-item">
            <div class="row">
                <div class="col-md-2"><b>Department</b></div>
                <div class="col-md-2"><b>Subject</b></div>
                <div class="col-md-2"><b>Assign to</b></div>
                <div class="col-md-2"><b>Status</b></div>
                <div class="col-md-2"><b>Date/Time</b></div>
            </div>
        </li>
        @foreach ($ticket->sortByDesc('created_at') as $ticket)

        <a href="{{ route('view.ticket',['ticketId' => $ticket->id]) }}" class="list-group-item list-group-item">
            <div class="row">
                <div class="col-md-2">{{ $ticket->category }}</div>
                <div class="col-md-2">{{ $ticket->subject }}</div>
                <div class="col-md-2">{{ $ticket->assignto }}</div>
                <div class="col-md-2">
                    @if ($ticket->status == 0)
                    <span class="badge badge-danger">Open</span>
                    @elseif ($ticket->status == 1 || $ticket->status == 2)
                    <span class="badge badge-danger">Processing</span>
                    @elseif ($ticket->status == 3)
                    <span class="badge badge-danger">Closed</span>
                    @endif
                </div>
                <div class="col-md-2">{{ $ticket->created_at->format('F j, Y, g:i A') }}</div>
            </div>
        </a>
        @endforeach
    @endif
    </ul>
    </div>
</div>
 @endsection
