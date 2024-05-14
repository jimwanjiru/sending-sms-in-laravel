<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card">
        @if (Session::has('sucess'))
        <div class="alert alert-success" role="alert">
            {{ session::get('success') }}
        </div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('fail') }}
            </div>
        @endif
    </div>
    <h2>Send SMS</h2>
    <form action="{{ route('sendSms') }}" method="POST" class="form">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send SMS</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
