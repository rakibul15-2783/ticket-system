@extends('admin.includes.master')
@section('main-content')
{{-- image size --}}
<style>
    .image-container {
    display: flex;
    gap: 10px;
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
            <p>/ Tickets / ticket_id #{{$ticket->id}}</p>
        </div>
    </div>
</div><br>
<div class="page-wrapper p-0">
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
                                            <option value="{{ $user->id }}" {{ $ticket->assignto === $user->id ? "selected" : ""}}>{{$user->email}}</option>
                                    @endforeach
                                </select><br>
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
        <div class="col-md-12 col-lg-8">
            <div class="chat-message " >
                <form action="{{ route('message.post',['ticketId' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group col-lg-6 mb-0">
                            <textarea type="text" name="message" class="form-control" placeholder="Reply here..."></textarea>
                        </div><br>
                        <div class="input-group col-lg-6 mb-0">
                            <input class="form-control mr-3"  name="images[]" id="images" type="file" multiple />
                            <button class="btn btn-info text-center"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row file-type">
                    <div class="input-group col-lg-6 mb-0 ">
                    @if (session('error'))
                       <span class="text-danger">{{ session('error') }}</span>
                    @endif
                   </div><br>
                    <div class="input-group col-lg-6 mb-0">
                        <div id="">
                            <span>File type: jpeg, png, jpg, gif</span>
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
            <div class="messages card">
            @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="card rounded border">
                <div class="card-header border-primary bg-light p-2">
                    @if ($message->user->role==1)
                    <small class="text-success"><b>Sent From Admin</b></small><br><small class="text-success">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                    @else
                    <small class="text-dark"><b>Sent From Customer</b></small><br><small class="text-dark">{{ $message->user->email }}</small><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                    @endif

                </div>
                <div class="card-body">
                        <p>{{ $message->message }}</p>
                </div>
                <div class="image-container ml-4 ">
                    @if ($message->images->count() > 0)
                        @foreach ($message->images as $image)
                        <div class="thumbnail ">
                            <img src="{{ asset('upload/images/'.$image->images) }}"  alt="Uploaded Image">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endforeach
            <div class="card border-primary ">
                <div class="card-header bg-light p-2">
                 <strong>{{ $ticket->name }}</strong><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <p>{{ $ticket->des }}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('#images').on('change', function(){
            jQuery('.file-type').hide();
            var files = jQuery(this).prop('files');
            var selectedFileText = '';
            for(var i = 0; i< files.length; i++){
                selectedFileText += ' ' +'<span>' + files[i].name + ' , ' + '</span>' ;
            }
            jQuery('#selected-files').html(selectedFileText);
        });
    });
</script>


@endsection
