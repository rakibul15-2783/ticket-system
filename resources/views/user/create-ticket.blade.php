@extends('user.includes.master')
@section('main-content')
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ New Ticket</p>
        </div>
    </div>
</div><br>
    <div class="row">
        <div class="col-md-12 col-lg-3">
            <strong>Your Recent Tickets</strong><br><br>
            @if ($ticket->isEmpty())
            <div class="card bg-white" style="width: 18rem;">
                <strong class=" text-center ">No ticket found</strong>
            </div>
            @else
            <div class="card bg-white" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                  @foreach ($ticket as $ticket)
                   <a href="{{ route('view.ticket', ['ticketId' => $ticket->id]) }}" class="list-group-item list-group-item"><li class="list-group-item"><strong>Subject: </strong>{{ $ticket->subject }}
                    @if ($ticket->status == 0)
                    <span class="badge badge-danger">Not Open</span>
                    @elseif ($ticket->status == 1 )
                    <span class="badge badge-danger">Assigned</span>
                    @elseif ($ticket->status == 2 )
                    <span class="badge badge-danger">Processing</span>
                    @elseif ($ticket->status == 3)
                    <span class="badge badge-danger">Closed</span>
                    @endif
                    </li></a>
                  @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="col-md-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">

                        <form action="{{ route('store.ticket') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" required class="form-control" id="name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" required class="form-control" id="email" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subject" value="" required class="form-control" id="subject" placeholder="Subject">
                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category" id="">
                                        <option value="">-----Choose Category-----</option>
                                        <option value="IT">IT</option>
                                        <option value="Technical">Technical</option>
                                        <option value="Mchanical">Mchanical</option>
                                    </select>
                                    @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="des" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="des" required class="form-control" id="des" placeholder="Describe Your Problem"></textarea>
                                    @error('des')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3  col-form-label"></label>
                                <div class="col-sm-9 ">
                                    <button type="submit" name="submit" class="btn btn-info px-5 btn-order text-center">Create Ticket</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
