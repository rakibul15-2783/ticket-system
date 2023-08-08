<?php use Carbon\Carbon; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 100px;
            border-radius: 10px;
            border-top: 0;
            border-bottom: 0;
            border-left: 4px solid #17a2b8;
            border-right: 4px solid #17a2b8;
        }
        .card-body {
            padding: 20px;
        }
        .btn-action {
            margin-right: 5px;
        }
        .badge-processing {
            background-color: #ffc107;
            color: #000;
        }
        .badge-done {
            background-color: #28a745;
            color: #fff;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Tickets</h3>
                        <a href="{{ route('ticket') }}" class="btn btn-info btn-action">Create a Ticket</a>
                        <a href="{{ route('show.ticket') }}" class="btn btn-success btn-action">VIew Tickets</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-action">Logout</a>
                    </div><br><br><br>
                    <div class="border p-4 rounded">
                        @if ($ticket->isEmpty())
                            <p class="text-info">No Ticket Found.</p>
                        @else
                            <h4 class="text-info">Your Ticket List</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticket->sortByDesc('created_at') as $ticket)
                                        <tr>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->category }}</td>
                                            <td>{{ $ticket->des }}</td>
                                            <td>{{ $ticket->created_at->format('F j, Y, g:i A') }}</td>
                                            <td><a href="" class="btn  btn-sm btn-info">View</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
