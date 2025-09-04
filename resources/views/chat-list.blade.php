<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Users to Chat With</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('chat.start', $u->id) }}" class="btn btn-primary btn-sm">Start Chat</a>
                    <form action="{{ route('chat.done', $u->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Done</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('profile') }}" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html>