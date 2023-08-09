@extends('admin.includes.master')
@section('main-content')
<style>
    body{
    background-color: #f4f7f6;
}
.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    border-left: 1px solid #eaeaea;
    max-height: 650px;
    overflow-y: auto;
}
.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6;
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px;

}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}
.chat .chat-history .profile img {
    border-radius: 80px;
    width: 80px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app {
        margin: 0;

    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}
</style>

<div class="row align-items-end">
    <div class="col-lg-9">
        <div class="page-header-title">
            <div class="d-inline">
                <h4>Open Ticket</h4>
            </div>
        </div>
    </div>
</div><br><br>
<div class="page-wrapper">
   <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card bg-white mb-3">
                <div class="card-header text-center"><h3>User Details</h3></div>
                    <div class="card-body">
                        <p class="card-text"><b>Name: </b> {{ $ticket->name }}</p>
                        <p class="card-text"><b>Email:</b> {{ $ticket->email }}</p>
                        <p class="card-text"><b>Subject:</b> {{ $ticket->subject }}</p>
                        <p class="card-text"><b>Category:</b> {{ $ticket->category }}</p>
                        <p class="card-text"><b>Description:</b> {{ $ticket->des }}</p>
                    </div>
            </div>
            <div class="card bg-white mb-3">
                <div class="text-center">
                    <h4>Assign to</h4>
                    <form action="{{ route('status.post',['ticketId' => $ticket->id]) }}" method="POST">
                        @csrf
                        <select name="assignto" class="text-center form-control" id="assignto">
                            <option value="{{ $ticket->assignto }}">{{ $ticket->user->name }}</option>
                            @foreach ($users as $user)
                                @if($user->role==2)
                                    <option value="{{ $user->id }}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                </div>
                    <div class="card-body">
                        <div class="text-center">

                                <select name="status" class="form-control text-center" id="status">
                                    <option value="0" @if ($ticket->status == 0) selected @endif>Unassigned</option>
                                    <option value="1" @if ($ticket->status == 1) selected @endif>Assigned</option>
                                    <option value="2" @if ($ticket->status == 2) selected @endif>Processing</option>
                                    <option value="3" @if ($ticket->status == 3) selected @endif>Closed</option>
                                </select>

                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card  chat-app">
                            <div class="chat">
                                <div class="chat-header bg-info clearfix">
                                    <div class="row ">
                                        <div class="col-lg-6 ">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                            </a>
                                            <div class="chat-about">
                                                <h6 class="m-b-0">{{ $ticket->user->name }}</h6>
                                                <small>Last seen: 2 hours ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-history">
                                    <div class="profile text-center">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                        </a>
                                        <div class="chat-about">
                                            <h3 class="m-b-0"><h3>{{ $ticket->user->name }}</h3>
                                            <button class="btn btn-info btn-sm">View Profile</button><br><br><br>

                                        </div>
                                    </div>
                                    <ul class="m-b-0">
                                        <li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">10:12 AM, Today</span>
                                            </div>
                                            <div class="message my-message">{{ $ticket->des }}</div>
                                        </li>
                                        @foreach ($messages as $message)
                                        @if ($message->user->role == 2)
                                        <li class="clearfix">
                                            <div class="message-data text-right">
                                                <span class="message-data-time">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                            </div>
                                            <div class="message other-message float-right">{{ $message->message }} </div>
                                        </li>
                                        @else
                                        <li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">{{ $message->created_at->format('F j, Y, g:i A') }}</span>
                                            </div>
                                            <div class="message my-message">{{ $message->message }}</div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="chat-message clearfix " >
                                    {{-- <form action="{{ route('messege.post') }}" method="POST"> --}}
                                        @csrf
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control" placeholder="Enter text here..."><button class="btn btn-info"><i class="fa-regular fa-paper-plane"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
