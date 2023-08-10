<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu active ">
                <a href="">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="active ">
                <a href="{{ route('ticket') }}">
                    <span class="pcoded-micon"><i class="fa-regular fa-paper-plane"></i></span>
                    <span class="pcoded-mtext">New Ticket</span>
                </a>
            </li>
            <li class="active ">
                <a href="{{ route('show.ticket') }}">
                    <span class="pcoded-micon"><i class="fa-solid fa-inbox"></i></span>
                    <span class="pcoded-mtext">My Tickets</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
