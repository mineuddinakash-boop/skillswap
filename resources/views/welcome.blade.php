<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Laravel Project</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #f8f9fa;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        .nav-left, .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .nav-right a, .nav-left a {
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            border: 1px solid #333;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .nav-right a:hover, .nav-left a:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="{{ url('/about') }}">About Us</a>
        </div>
        <div class="nav-right">
            <a href="{{ route('login') }}">Sign In</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <div style="text-align:center; margin-top:50px;">
        <h1>Welcome to SkillSwap App</h1>
        <p>This is the homepage</p>
    </div>
</body>
</html>
