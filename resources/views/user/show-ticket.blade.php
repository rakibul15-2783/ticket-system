@extends('user.includes.master')
@section('main-content')

<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ My Tickets</p>
        </div>
    </div>
    <div class="text-right">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div><br>
<div class="container">
    <strong>Your All Tickets</strong><br><br>
    <div class="card shadow">
        @if ($tickets->isEmpty())
        <h4 class=" text-center m-3">NO TICKET FOUND.</h4>
        @else
        <ul class="list-group">
            <li class="list-group-item list-group-item">
                <div class="row">
                    <div class="col-md-1"><b>Sl</b></div>
                    <div class="col-md-2"><b>Department</b></div>
                    <div class="col-md-2"><b>Subject</b></div>
                    <div class="col-md-3"><b>Assign to</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                    <div class="col-md-2"><b>Last Update</b></div>
                </div>
            </li>
            <li>
            @foreach ($tickets->sortByDesc('created_at') as $sl => $ticket)
            @php
                $serialNumber = ($tickets->currentPage() - 1) * $tickets->perPage() + $sl + 1;
            @endphp
            <a href="{{ route('view.ticket',['ticketId' => $ticket->id]) }}" class="list-group-item list-group-item">
                <div class="row">
                    <div class="col-md-1">{{ $serialNumber }}</div>
                    <div class="col-md-2">{{ $ticket->category }}</div>
                    <div class="col-md-2">#{{ $ticket->id }}<br>{{ $ticket->subject }}</div>
                    <div class="col-md-3">
                        @if ($ticket->assignee)
                            {{ $ticket->assignee->email }}
                        @else
                            Not Assigned
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->status == 0)
                        <span class="badge badge-danger">Not Open</span>
                        @elseif ($ticket->status == 1 )
                        <span class="badge badge-success">Assigned</span>
                        @elseif ($ticket->status == 2 )
                        <span class="badge badge-info">Processing</span>
                        @elseif ($ticket->status == 3)
                        <span class="badge badge-warning">Closed</span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        @if ($ticket->latestMessage)
                            {{ $ticket->latestMessage->created_at->format('d-m-Y (h:i A)') }}
                        @else
                            No updates yet
                        @endif
                    </div>
                </div>
            </a>
            </li>

            @endforeach
            <li class="list-group-item list-group-item ">
                <div class="pagination justify-content-end">
                    {{ $tickets->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </li>
        </ul>
        @endif
    </div>
</div>

 @endsection


