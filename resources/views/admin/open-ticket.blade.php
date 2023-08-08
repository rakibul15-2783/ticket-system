@extends('admin.includes.master')
@section('main-content')
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
            <div class="card bg-light mb-3">
                <div class="card-header text-center"><h3>User Details</h3></div>
                    <div class="card-body">
                        <p class="card-text"><b>Name: </b> {{ $ticket->name }}</p>
                        <p class="card-text"><b>Email:</b> {{ $ticket->email }}</p>
                        <p class="card-text"><b>Subject:</b> {{ $ticket->subject }}</p>
                        <p class="card-text"><b>Category:</b> {{ $ticket->category }}</p>
                        <p class="card-text"><b>Description:</b> {{ $ticket->des }}</p>
                    </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card bg-light mb-3">
                <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Light card title</h5>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis nisi cum repudiandae? Perferendis amet quia quos iste. Fuga error adipisci nostrum, illo expedita labore repellendus itaque deleniti deserunt officiis praesentium.
                        Repellendus, temporibus fuga! Aperiam dolores aut eaque officiis accusamus quasi. Suscipit natus, sequi hic iste dolore autem quo cupiditate. Dolorem officiis quasi ea, natus facere atque eligendi praesentium alias laborum.
                        Neque harum repellendus laborum reprehenderit aspernatur cupiditate recusandae voluptatibus? Iusto vel autem reiciendis aliquam quam, facere inventore labore exercitationem perspiciatis dolorem distinctio, omnis id nulla? Quod, eligendi. Nisi, ducimus molestias!
                        Perspiciatis, repellendus? Doloremque, iusto quaerat fugiat perspiciatis odio dolorum voluptatum consectetur cupiditate, rem provident, cum at porro corrupti aliquid aperiam cumque dicta consequuntur? Possimus magnam, dicta totam ratione asperiores eos!
                        Voluptatibus iusto asperiores maxime dolore? Eaque molestiae dolore fugit sint sequi, esse suscipit fuga qui quidem architecto magni sed quos doloribus beatae molestias pariatur minima perferendis ut voluptate quia ullam!
                        Quisquam molestiae blanditiis voluptas, doloribus consequuntur ratione atque. Tempore, iure ipsa minus fugit velit natus consectetur harum neque commodi, saepe, amet fugiat! Veritatis natus hic assumenda perspiciatis, beatae neque consequatur.
                        Quae voluptatem praesentium, ea maxime nam eligendi nisi unde mollitia sed aut! Quo, molestiae reprehenderit placeat odit omnis sint eos natus quidem inventore eum qui? Similique at distinctio dicta maiores!.</p>
                    </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card bg-light mb-3">
                <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Light card title</h5>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis nisi cum repudiandae? Perferendis amet quia quos iste. Fuga error adipisci nostrum, illo expedita labore repellendus itaque deleniti deserunt officiis praesentium.
                        Repellendus, temporibus fuga! Aperiam dolores aut eaque officiis accusamus quasi. Suscipit natus, sequi hic iste dolore autem quo cupiditate. Dolorem officiis quasi ea, natus facere atque eligendi praesentium alias laborum.
                        Neque harum repellendus laborum reprehenderit aspernatur cupiditate recusandae voluptatibus? Iusto vel autem reiciendis aliquam quam, facere inventore labore exercitationem perspiciatis dolorem distinctio, omnis id nulla? Quod, eligendi. Nisi, ducimus molestias!
                        Perspiciatis, repellendus? Doloremque, iusto quaerat fugiat perspiciatis odio dolorum voluptatum consectetur cupiditate, rem provident, cum at porro </p>
                    </div>
            </div>
        </div>

    </div>
</div>

@endsection
