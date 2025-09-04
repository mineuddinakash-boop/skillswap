<!DOCTYPE html>
<html>
<head>
    <title>Chat History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Chat History</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Done On</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($history as $h)
            <tr>
                <td>{{ $h->name }}</td>
                <td>{{ $h->created_at }}</td>
                <td>
                    @if($h->rating)
                        {{ $h->rating }} / 5
                    @else
                        <form action="{{ route('history.rate', $h->id) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <select name="rating" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Rate</option>
                                @for($i=1; $i<=5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No history available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('profile') }}" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html>
