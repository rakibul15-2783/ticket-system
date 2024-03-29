@extends('admin.includes.master')
@section('title')
Ticket Details
@endsection
@section('main-content')

<link rel="stylesheet" href="{{ asset('admin') }}\files\assets\css\custom.css">

<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ Tickets / ticket_id #{{$ticket->id}}</p>
        </div>
    </div>
</div><br>
<div class="page-wrapper p-0">
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <h5>Tickets</h5><br>
            <div class="card bg-white" style="width: 18rem;">
                <ul class="list-group list-group-flush" id="listofTicket">

                    @foreach($ticketList as $singleTicket)
                    <a href="{{ route('open.ticket', ['ticketId' => $singleTicket->id]) }}" class="list-group-item {{ $singleTicket->assignto === auth()->user()->id || $singleTicket->assignto == '' ? '':'disable-link'}}">
                        <li>
                            #{{ $singleTicket->id }} - {{ $singleTicket->subject }}
                        </li>
                    </a>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            @if($ticket->status !=3)
            <div class="chat-message ">
                <form action="{{ route('admin.message.post',['ticketId' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group col-lg-6 mb-0">
                            <textarea type="text" name="message" class="form-control" placeholder="Reply here..."></textarea>
                        </div>
                        <div class="input-group col-lg-6 mb-0">
                            <input class="form-control mr-3" name="images[]" id="images" type="file" multiple />
                            <button class="btn btn-info text-center"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row file-type">
                    <div class="input-group col-lg-6 mb-0 mt-1">
                        @if($errors->has('message'))
                        <span class="text-danger">Message field is required!</span>
                        @endif
                    </div><br>
                    <div class="input-group col-lg-6 mb-0 mt-1">
                        <div id="">
                            @if($errors->has('images*'))
                            <span class="text-danger">File type must be jpeg, png, jpg, gif</span>
                            @else
                            <span>File type: jpeg, png, jpg, gif</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group col-lg-6 mb-0">
                    </div><br>
                    <div class="input-group col-lg-6 mb-0">
                        <div id="selected-files">
                        </div>
                    </div>
                </div>
            </div><br>
            @endif
            <div class="messages card">
                @if(!$messages->isEmpty())
                @foreach ($messages as $message)
                <div class="card rounded border">
                    <div class="card-header bg-light p-2 {{ $message->user->role==1 ? 'border-primary':'border-success'}}">
                        @if ($message->user->role==1)
                        <small class="text-success"><b>{{ $message->user->name }}</b></small><br><small class="text-success">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                        @else
                        <small class="text-dark"><b>{{ $message->user->name }}</b></small><br><small class="text-dark">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                        @endif

                    </div>
                    <div class="card-body">
                        <p class='text-color'>{{ $message->message }}</p>
                    </div>
                    <div class="image-container ml-4 ">
                        @if ($message->images->count() > 0)
                        @foreach ($message->images as $image)
                        <div class="thumbnail ">
                            <img src="{{ asset('upload/images/'.$image->images) }}" alt="Uploaded Image">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endforeach
                @endif

                @if(!is_null($ticket))
                <div class="card border-success ">
                    <div class="card-header bg-light p-2">
                        <small class="text-dark"><b>{{ $ticket->name }}</b></small></small><br><small class="text-dark">{{ $ticket->email }}</small><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <p class='text-color'>{{ $ticket->des }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3">
            <h5>Ticket Information</h5><br>
            <div class="card bg-white" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p><b>Name: </b></p> {{ $ticket->name }}
                    </li>
                    <li class="list-group-item">
                        <p><b>Email:</b> </p>{{ $ticket->email }}
                    </li>
                    <li class="list-group-item">
                        <p><b>Subject:</b></p> {{ $ticket->subject }}
                    </li>
                    <li class="list-group-item">
                        <p><b>Category:</b></p> {{ $ticket->category }}
                    </li>
                    <li class="list-group-item">
                        <p><b>Status/Priority:</b> </p>
                        @if ($ticket->status == 0)
                        <span class="badge badge-danger">NOT OPEN</span>
                        @elseif ($ticket->status == 1 )
                        <span class="badge badge-warning">ASSIGNED</span>
                        @elseif ($ticket->status == 2 )
                        <span class="badge badge-info">PROCESSING</span>
                        @elseif ($ticket->status == 3)
                        <span class="badge badge-success">CLOSED</span>
                        @endif
                        @if ($ticket->priority == 0)
                        <span>/ Low</span>
                        @elseif ($ticket->status == 1 )
                        <span>/ Medium</span>
                        @elseif ($ticket->status == 2 )
                        <span>/ High</span>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card bg-white" style="width: 18rem;">
                <div class="text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p><b>Assign to </b></p>

                            <form action="{{ route('status.post', ['ticket' => $ticket]) }}" method="POST">
                                @csrf
                                <select name="assignto" class="text-center form-control" id="assignto">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $ticket->assignto === $user->id ? "selected" : ""}}>{{$user->email}}</option>
                                    @endforeach
                                </select><br>
                                <select name="status" class="form-control text-center" id="status">
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
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#images').on('change', function() {
            jQuery('.file-type').hide();
            var files = jQuery(this).prop('files');
            var selectedFileText = '';
            for (var i = 0; i < files.length; i++) {
                selectedFileText += ' ' + '<span>' + files[i].name + ' , ' + '</span>';
            }
            jQuery('#selected-files').html(selectedFileText);
        });
    });
</script>

<script>
    $(document).ready(function() {

        let authUserId = <?php echo auth()->user()->id; ?>

        setInterval(function() {

            let listofTicket = document.getElementById('listofTicket');

            $.ajax({

                type: 'GET',
                method: 'GET',
                url: "{{ route('api.listofTicket') }}",
                success: function(response) {

                    let listItem = '';
                    response.forEach(function(item) {

                        let ticketId = item.id;
                        let openTicket = "{{ route('open.ticket', ':ticketId') }}";
                        openTicket = openTicket.replace(':ticketId', ticketId);

                        listItem += ` <a href="${openTicket}" class="list-group-item ${item.assignto === authUserId || item.assignto == '' ? '':'disable-link'}">
                                <li>
                                    #000${item.id} - ${item.subject}
                                </li>
                            </a>`
                    });
                    listofTicket.innerHTML = listItem;
                },
                error: function(err) {
                    console.log(err);
                }
            });

        }, 60000);
    });
</script>
@endsection