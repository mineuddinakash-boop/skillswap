@php use Illuminate\Support\Facades\Auth; @endphp

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2 style="text-align:center;">Edit Profile</h2>
    <form method="POST" action="{{ route('profile.update') }}" style="width: 300px; margin: 0 auto;">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ $user->name }}" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ $user->phone }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ $user->email }}" required><br><br>

        <label>Skill:</label><br>
        <input type="text" name="skill" value="{{ $user->skill }}" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
