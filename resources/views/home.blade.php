<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="mb-4">Welcome to Our Project</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('signup.form') }}" class="btn btn-primary btn-lg mx-2">Signup</a>
    <a href="{{ route('login.form') }}" class="btn btn-success btn-lg mx-2">Login</a>
</div>

</body>
</html>
