@extends('admin.includes.master')
@section('main-content')
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ Tickets</p>
        </div>
    </div>
</div><br>
<div class="container">
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <form action="{{ route('search.tickets') }}" methot="POST">
                <div class="input-group">
                    <input class="form-control" name="search" placeholder="Search by your email..." type="text">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow">
        <ul class="list-group">
            <li class="list-group-item list-group-item">
                <div class="row">
                    <div class="col-md-2"><b>Department</b></div>
                    <div class="col-md-2"><b>Subject</b></div>
                    <div class="col-md-2"><b>Assign to</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                    <div class="col-md-2"><b>Last Update</b></div>
                </div>
            </li>
            @foreach ($tickets->sortByDesc('created_at') as $ticket)
            @if ($ticket->assignto === auth()->user()->id || $ticket->assignto == "")
            <a href="{{ route('open.ticket', ['ticketId' => $ticket->id]) }}" class="list-group-item list-group-item">
                <div class="row">
                    <div class="col-md-2">{{ $ticket->category }}</div>
                    <div class="col-md-2">{{ $ticket->subject }}</div>
                    <div class="col-md-2">
                        @if ($ticket->assignee)
                        {{ $ticket->assignee->email }}
                        @else
                        Not Assigned
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->status == 0)
                        <span class="badge badge-danger">Open</span>
                        @elseif ($ticket->status == 1 )
                        <span class="badge badge-warning">Assigned</span>
                        @elseif ($ticket->status == 2 )
                        <span class="badge badge-info">Processing</span>
                        @elseif ($ticket->status == 3)
                        <span class="badge badge-success">Closed</span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->latestMessage)
                        {{ $ticket->latestMessage->created_at->format('F j, Y, g:i A') }}
                        @else
                        No updates yet
                        @endif
                    </div>
                </div>
            </a>
            @else
            <a class="list-group-item list-group-item">
                <div class="row">
                    <div class="col-md-2">{{ $ticket->category }}</div>
                    <div class="col-md-2">{{ $ticket->subject }}</div>
                    <div class="col-md-2">
                        @if ($ticket->assignee)
                        {{ $ticket->assignee->email }}
                        @else
                        Not Assigned
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->status == 0)
                        <span class="badge badge-danger">Open</span>
                        @elseif ($ticket->status == 1 )
                        <span class="badge badge-warning">Assigned</span>
                        @elseif ($ticket->status == 2 )
                        <span class="badge badge-info">Processing</span>
                        @elseif ($ticket->status == 3)
                        <span class="badge badge-success">Closed</span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->latestMessage)
                        {{ $ticket->latestMessage->created_at->format('F j, Y, g:i A') }}
                        @else
                        No updates yet
                        @endif
                    </div>
                </div>
            </a>
            @endif
            @endforeach
        </ul>
    </div>
</div>
@endsection