<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2 style="text-align:center;">Search Results</h2>

    @if($results->isEmpty())
        <p style="text-align:center;">No users found with that skill.</p>
    @else
        <table border="1" style="margin: 0 auto; text-align: center;">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skill</th>
                <th>Action</th>
            </tr>
            @foreach($results as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->skill }}</td>
                    <td>
                        <form method="POST" action="{{ route('send-request', ['toUserId' => $user->id]) }}">
                            @csrf
                            <button type="submit">Add</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <div style="text-align:center; margin-top: 20px;">
        <a href="{{ route('profile') }}"><button>Back to Profile</button></a>
    </div>
</body>
</html>