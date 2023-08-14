@extends('user.includes.master')
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
                <form action="{{ route('userMessage.post',['ticketId' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group col-lg-6 mb-0">
                            <textarea type="text" name="message" class="form-control" placeholder="Reply here..."></textarea>
                        </div><br>
                        <div class="input-group col-lg-6 mb-0">
                            <input class="form-control  mr-3" name="images[]" id="user-images" type="file" multiple />
                            <button class="btn btn-info text-center"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form> 
                <div class="row file-type">
                    <div class="input-group col-lg-6 mb-0">
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
                        <div id="user-selected-files">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="messages">
            @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="card  border-primary">
                <div class="card-header bg-light p-2">
                 <strong>{{ $message->user->name }}</strong><span class="text-right">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                        <p>{{ $message->message }}</p>
                </div>
                <div class="image-container p-0">
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
            <div class="card border-primary">
                <div class="card-header bg-light p-2">
                 <strong>{{ $ticket->name }}</strong><span class="text-right">{{ $ticket->created_at->format('F j, Y, g:i A') }}</span>
                </div>
                <div class="card-body">
                        <p>{{ $ticket->des }}</p>
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
