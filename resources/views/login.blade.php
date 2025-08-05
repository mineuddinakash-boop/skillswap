<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2 style="text-align:center;">Sign In</h2>
    <form method="POST" action="{{ route('login.submit') }}" style="width: 300px; margin: 0 auto;">
        @csrf

        @if($errors->any())
            <div style="color: red;">
                {{ $errors->first() }}
            </div>
        @endif

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
