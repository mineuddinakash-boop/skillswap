<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    
    {{-- Import the Auth class --}}
    @php use Illuminate\Support\Facades\Auth; @endphp

    <form method="POST" action="{{ route('logout') }}" style="text-align:right; margin: 10px;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    <form method="POST" action="{{ route('search') }}" style="text-align:center; margin-top: 20px;">
        @csrf
        <input type="text" name="skill" placeholder="Search by skill" required>
        <button type="submit">Search</button>
    </form>


    <h2 style="text-align:center;">Welcome, {{ Auth::user()->name }}</h2>
    <p style="text-align:center;">Email: {{ Auth::user()->email }}</p>
    <p style="text-align:center;">Phone: {{ Auth::user()->phone }}</p>
    <p style="text-align:center;">Skill: {{ Auth::user()->skill }}</p>

    <div style="text-align:center; margin-top: 20px;">
        <a href="{{ route('profile.edit') }}">
            <button>Edit Profile</button>
        </a>
        <a href="{{ route('skills') }}">
            <button>View Available Skills</button>
        </a>
        <a href="{{ route('dashboard') }}">
            <button>Dashboard</button>
        </a>
        <a href="{{ route('chat') }}">
            <button>Chat</button>
        </a>
    </div>
    
</body>
</html>