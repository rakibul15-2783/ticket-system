<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ request()->is('admin-dashboard*') ? 'active':''}}">
                <a href="">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <!-- <li class="{{ request()->is('show-tickets*') ? 'active':''}}">
                <a href="{{ route('show.tickets') }}">
                    <span class="pcoded-micon"><i class="fa-regular fa-paper-plane"></i></span>
                    <span class="pcoded-mtext">Tickets</span>
                </a>
            </li> -->

            @foreach($tickets as $ticket)
            <li class="" id="listofTicket">
                <a href="{{ route('open.ticket', ['ticketId' => $ticket->id]) }}">
                    <span class="pcoded-micon"><i class="fa-regular fa-paper-plane"></i></span>
                    <span class="pcoded-mtext">
                        #000{{ $ticket->id }} - {{ $ticket->subject }}
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>