<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h3>Your Notifications</h3>
                </div>
                <div class="card-body">
                    @if($notifications->isEmpty())
                        <p class="text-center text-muted">No notifications.</p>
                    @else
                        <ul class="list-group">
                            @foreach($notifications as $note)
                                <li class="list-group-item">
                                    {{ $note->message }} <span class="text-muted float-end">{{ $note->created_at }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('profile') }}" class="btn btn-secondary">Back to Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
