@extends('admin.includes.master')
@section('main-content')
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <div class="d-inline">
                <h4>Tickets</h4>
            </div>
        </div>
    </div>
</div><br><br>
<div class="container">
    @foreach ($tickets as $ticket)
    <li class="list-group-item list-group-item-primary">
        <div class="row">
            <div class="col-md-3"><b><u>Subject</u></b></div>
            <div class="col-md-3"><b><u>Category</u></b></div>
            <div class="col-md-3"><b><u>Date/Time</u></b></div>
        </div>
        <div class="row">
            <div class="col-md-3">{{ $ticket->subject }}</div>
            <div class="col-md-3">{{ $ticket->category }}</div>
            <div class="col-md-3">{{ $ticket->created_at->format('F j, Y, g:i A') }}</div>
            <div class="col-md-3"><a href="{{ route('open.ticket', ['ticketId' => $ticket->id]) }}" class="badge badge-danger">Open</a>
        </div>
    </li><br>
    @endforeach
</div>

@endsection
