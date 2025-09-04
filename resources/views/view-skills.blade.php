<!DOCTYPE html>
<html>
<head>
    <title>Available Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-3">Available Skills</h3>

    {{-- Top 3 Rated Users --}}
    <div class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Top Rated Users
            </div>
            <div class="card-body">
                @if(isset($topRated) && $topRated->isNotEmpty())
                    <div class="row">
                        @foreach($topRated as $t)
                            <div class="col-md-4 mb-2">
                                <div class="p-2 border rounded">
                                    <strong>{{ $t->name }}</strong><br>
                                    <small class="text-muted">Avg rating: {{ number_format($t->avg_rating, 1) }} / 5</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mb-0 text-muted">No ratings yet.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Search & Filter Form --}}
    <form method="GET" action="{{ route('skills.view') }}" class="mb-3 d-flex">
        <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Search by skill (have or want)...">

        <select name="category" class="form-select me-2" style="max-width:220px;">
            <option value="">All Categories</option>
            <option value="hard skill" {{ (request('category') == 'hard skill' || (isset($category) && $category == 'hard skill')) ? 'selected' : '' }}>Hard Skill</option>
            <option value="soft skill" {{ (request('category') == 'soft skill' || (isset($category) && $category == 'soft skill')) ? 'selected' : '' }}>Soft Skill</option>
        </select>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Swap requests table --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>User Name</th>
                <th>Average Rating</th>
                <th>Skill Category</th>
                <th>Skill Have</th>
                <th>Skill Source</th>
                <th>Skill Want</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($swapRequests as $sr)
            <tr>
                <td>{{ $sr->user_name }}</td>
                <td>{{ number_format($sr->average_rating ?? 0, 1) }} / 5</td>
                <td>{{ ucfirst($sr->skill_category) }}</td>
                <td>{{ $sr->skill_have }}</td>
                <td>{{ $sr->skill_source }}</td>
                <td>{{ $sr->skill_want }}</td>
                <td>
                    <form action="{{ route('add.swap', $sr->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Add</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No available skills found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('profile') }}" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html>
