@extends('user.includes.master')
@section('main-content')
{{-- image size --}}
<style>
    .image-container {
    display: flex;
    gap: 10px;
}

.text-color{
    color: #000;
}

.thumbnail img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 1px solid #ccc;
}
.messages {
    padding: 10px;
    color: white;
    padding: 15px;
    height: 760px;
    overflow: scroll;
    border: 1px solid #ccc;
}
</style>
<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <p>/ My Tickets / ticket_id #000{{$ticket->id}}</p>
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
              <li class="list-group-item"><p><b>Department:</b> </p>{{ $ticket->category }}</li>
              <li class="list-group-item"><p><b>Submited:</b></p> {{ $ticket->created_at->format('F j, Y ( g:i A )') }}</li>
              <li class="list-group-item"><p><b>Last Update:</b></p>
                    @if ($ticket->latestMessage)
                    {{ $ticket->latestMessage->created_at->format('d-m-Y (h:i A)') }}
                    @else
                        No updates yet
                    @endif
              </li>
              <li class="list-group-item"><p><b>Status/Priority:</b> </p>
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
                       <span >/ Low</span>
                    @elseif ($ticket->priority == 1 )
                       <span >/ Medium</span>
                    @elseif ($ticket->priority == 2 )
                       <span >/ High</span>
                    @endif
              </li>
            </ul>
        </div>
    </div>
    @endif
        <div class="col-md-12 col-lg-8">
            @if($ticket->status !=3)
            <div class="chat-message " >
                <form action="{{ route('user.message.post',['ticketId' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group col-lg-6 mb-0">
                            <textarea type="text" name="message" class="form-control" placeholder="Reply here..."></textarea>

                        </div><br>
                        <div class="input-group col-lg-6 mb-0">
                            <input class="form-control  mr-3" name="images[]" id="user-images" type="file" multiple />
                            <button class="btn btn-info text-center"><i class="fa-regular fa-paper-plane"></i></button>
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="row file-type">
                    <div class="input-group col-lg-6 mb-0 ">
                        @error('message')
                                <div class="text-danger">The message field is required.</div>
                        @enderror
                       </div><br>
                    <div class="input-group col-lg-6 mb-0">
                        @if($errors->has('images*'))
                            <span class="text-danger">File type must be jpeg, png, jpg, gif</span>
                        @else
                            <span>File type: jpeg, png, jpg, gif</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-group col-lg-6 mb-0">
                    </div><br>
                    <div class="input-group col-lg-6 mb-0">
                        <div id="user-selected-files">
                        </div>
                    </div>
                </div>
            </div><br>
            @endif
            <div class="messages card">
            @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="card  rounded border">
                <div class="card-header bg-light p-2 {{ $message->user->role==1 ? 'border-primary':'border-success'}}">
                    @if ($message->user->role==1)
                    <small class="text-success"><b>{{ $message->user->name }}</b></small><br><small class="text-success">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                    @else
                    <small class="text-dark"><b>{{ $message->user->name }}</b></small><br><small class="text-dark">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                    @endif

                </div>
                <div class="card-body text-color">
                        <p>{{ $message->message }}</p>
                </div>
                <div class="image-container ml-4">
                    @if ($message->images->count() > 0)
                    @foreach ($message->images as $image)
                        <div class="thumbnail">
                            <img src="{{ asset('upload/images/'.$image->images) }}" alt="Uploaded Image">
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            @endforeach
            <div class="card border-success">
                <div class="card-header bg-light p-2">
                    <small class="text-dark"><b>{{ $ticket->name }}</b></small></small><br><small class="text-dark">{{ $ticket->email }}</small><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <p class='text-color'>{{ $ticket->des }}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('#user-images').on('change', function(){
            jQuery('.file-type').hide();
            var files = jQuery(this).prop('files');
            var selectedFileText = '';
            for(var i = 0; i< files.length; i++){
                selectedFileText += ' ' +'<span>' + files[i].name + ' , ' + '</span>' ;
            }
            jQuery('#user-selected-files').html(selectedFileText);
        });
    });
</script>
@endsection
