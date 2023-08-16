<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>A new ticket is created</h3>
    <strong>Ticket id- :</strong><p>#000{{ $ticket->id }}</p>
    <strong>Subject:</strong><p>{{ $ticket->subject }}</p>
    <strong>Department:</strong><p>{{ $ticket->category }}</p>
    <strong>Priority:</strong><p>
        @if ($ticket->priority == 0)
            <span >Low</span>
        @elseif ($ticket->priority == 1 )
            <span >Medium</span>
        @elseif ($ticket->priority == 2 )
            <span >High</span>
        @endif
    </p>
</body>
</html>
