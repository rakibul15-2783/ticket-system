@extends('user.includes.master')
@section('main-content')
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ My Tickets / Ticket</p>
        </div>
    </div>
</div><br>
   <div class="row">
    @if ($ticket)
    <div class="col-md-12 col-lg-3">
        <strong>Ticket Information</strong><br><br>
        <div class="card bg-white" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><p><b>Name: </b></p> {{ $ticket->name }}</li>
              <li class="list-group-item"><p><b>Email:</b> </p>{{ $ticket->email }}</li>
              <li class="list-group-item"><p><b>Subject:</b></p> {{ $ticket->subject }}</li>
              <li class="list-group-item"><p><b>Category:</b></p> {{ $ticket->category }}</li>
              <li class="list-group-item"><p><b>Description:</b> </p>{{ $ticket->des }}</li>
            </ul>
        </div>
    </div>
    @endif
        <div class="col-md-12 col-lg-8">
            <div class="chat-message " >
                <form action="{{ route('message.post',['ticketId' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group col-lg-6 mb-0">
                            <textarea type="text" name="message" class="form-control" placeholder="Reply here..."></textarea>
                        </div><br>
                        <div class="input-group col-lg-6 mb-0">
                            <input class="form-control  mr-3" id="formFileSm" type="file" multiple />
                            <button class="btn btn-info text-center"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div><br><br>
            @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="card  border-primary">
                <div class="card-header bg-light">
                 <strong>{{ $message->user->name }}</strong><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $message->message }}</p>
                    </blockquote>
                </div>
            </div>
            @endforeach
            <div class="card border-primary">
                <div class="card-header bg-light">
                 <strong>{{ $ticket->name }}</strong><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $ticket->des }}</p>
                    </blockquote>
                </div>
            </div>
        </div>
   </div>
@endsection
