<!DOCTYPE html>
<html>
<head>
    <title>Chat with {{ $chatWith->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h4>Chat with {{ $chatWith->name }}</h4>
    <div class="card shadow mb-3 p-3" style="height:400px; overflow-y:scroll;">
        @foreach($messages as $msg)
            <div class="mb-2">
                <strong>{{ $msg->from_user == session('user')->id ? 'You' : $chatWith->name }}:</strong>
                {{ $msg->message }}
                <small class="text-muted float-end">{{ $msg->created_at }}</small>
            </div>
        @endforeach
    </div>
    <form action="{{ route('chat.send', $chatWith->id) }}" method="POST" class="d-flex">
        @csrf
        <input type="text" name="message" class="form-control me-2" placeholder="Type a message..." required>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
    <a href="{{ route('chat.list') }}" class="btn btn-secondary mt-3">Back to Users</a>
</div>
</body>
</html>
