<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket-system</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 100px;
            border-radius: 10px;
        }
        .card-body {
            padding: 40px;
        }
        .btn-order {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3>Create Ticket</h3>
                        <a href="{{ route('ticket') }}" class="btn btn-info btn-action">Create a Ticket</a>
                        <a href="{{ route('show.ticket') }}" class="btn btn-success btn-action">VIew Tickets</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-action">Logout</a>
                    </div><br><br><br>
                        <form action="{{ route('store.ticket') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" required class="form-control" id="name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" required class="form-control" id="email" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subject" value="" required class="form-control" id="subject" placeholder="Subject">
                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category" id="">
                                        <option value="">-----Choose Category-----</option>
                                        <option value="IT">IT</option>
                                        <option value="Technical">Technical</option>
                                        <option value="Mchanical">Mchanical</option>
                                    </select>
                                    @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="des" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="des" required class="form-control" id="des" placeholder="Describe Your Problem"></textarea>
                                    @error('des')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3  col-form-label"></label>
                                <div class="col-sm-9 ">
                                    <button type="submit" name="submit" class="btn btn-info px-5 btn-order text-center">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
