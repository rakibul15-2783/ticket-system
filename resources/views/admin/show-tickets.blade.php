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
                    <div class="col-md-1"><b>SL</b></div>
                    <div class="col-md-2"><b>Department</b></div>
                    <div class="col-md-2"><b>Subject</b></div>
                    <div class="col-md-3"><b>Assign to</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                    <div class="col-md-2"><b>Last Update</b></div>
                </div>
            </li>
            @if(!$tickets->isEmpty())
                @foreach ($tickets as $sl => $ticket)
                @php
                    $serialNumber = ($tickets->currentPage() - 1) * $tickets->perPage() + $sl + 1;
                @endphp
                <a @if($ticket->assignto === auth()->user()->id || $ticket->assignto == "")
                    href="{{ route('open.ticket', ['ticketId' => $ticket->id]) }}" @endif class="list-group-item
                    list-group-item">
                    <div class="row">
                        <div class="col-md-1">{{ $serialNumber }}</div>
                        <div class="col-md-2">{{ $ticket->category }}</div>
                        <div class="col-md-2">{{ $ticket->subject }}</div>
                        <div class="col-md-3">
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
                               <span class="badge badge-success">{{ $ticket->latestMessage->created_at->format('F j, Y ( g:i A )') }}</span>
                            @else
                            <span class="badge badge-secondary">No updated yet</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            @else
                <div class="row" style='align-item:center;justify-content:center;margin-top:10px;font-weight:bold'>
                    <p>Ticket not available!</p>
                </div>
            @endif
            <li class="list-group-item list-group-item ">
                <div class="pagination justify-content-end">
                    {{ $tickets->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
