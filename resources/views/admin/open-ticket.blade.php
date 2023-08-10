@extends('admin.includes.master')
@section('main-content')
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
                <h4>Open Ticket</h4>
        </div>
    </div>
</div><br><br>
<div class="page-wrapper">
   <div class="row">
        <div class="col-md-12 col-lg-3">
            <h5>Ticket Information</h5><br>
            <div class="card bg-white" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><p><b>Name: </b></p> {{ $ticket->name }}</li>
                  <li class="list-group-item"><p><b>Email:</b> </p>{{ $ticket->email }}</li>
                  <li class="list-group-item"><p><b>Subject:</b></p> {{ $ticket->subject }}</li>
                  <li class="list-group-item"><p><b>Category:</b></p> {{ $ticket->category }}</li>
                  <li class="list-group-item"><p><b>Description:</b> </p>{{ $ticket->des }}</li>
                </ul>
            </div>
            <div class="card bg-white" style="width: 18rem;">
                <div class="text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p><b>Assign to </b></p>
                        
                            <form action="{{ route('status.post', ['ticket' => $ticket]) }}" method="POST">
                                @csrf
                                <select name="assignto" class="text-center form-control" id="assignto">
                                    @foreach ($users as $user)
                                        @if($user->role===1)
                                            <option value="{{ $user->id }}" {{ $ticket->assignto === $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <select name="status" class="form-control text-center" id="status">
                                    <option value="0" @if ($ticket->status === 0) selected @endif>Unassigned</option>
                                    <option value="1" @if ($ticket->status === 1) selected @endif>Assigned</option>
                                    <option value="2" @if ($ticket->status === 2) selected @endif>Processing</option>
                                    <option value="3" @if ($ticket->status === 3) selected @endif>Closed</option>
                                </select>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-sm btn-info">Save</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-9">
            <div class="card shadow rounded border-primary">
                <div class="card-header bg-light">
                 <strong>{{ $ticket->name }}</strong><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $ticket->des }}</p>
                    </blockquote>
                </div>
            </div>
            @foreach ($messages->sortBy('created_at') as $message)
            <div class="card rounded border-primary">
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
        </div>
   </div>
</div>



@endsection
