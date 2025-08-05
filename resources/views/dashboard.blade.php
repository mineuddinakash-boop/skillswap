<h2>Incoming Requests</h2>
@foreach($incoming as $req)
    <p>{{ $req->fromUser->name }} ({{ $req->fromUser->skill }})
        <form method="POST" action="{{ route('request-action', ['id' => $req->id, 'action' => 'accepted']) }}" style="display:inline">@csrf <button>Accept</button></form>
        <form method="POST" action="{{ route('request-action', ['id' => $req->id, 'action' => 'rejected']) }}" style="display:inline">@csrf <button>Reject</button></form>
    </p>
@endforeach

<h2>Outgoing Requests</h2>
@foreach($outgoing as $req)
    <p>To: {{ $req->toUser->name }} - Status: {{ $req->status }}
        <form method="POST" action="{{ route('unsend-request', $req->id) }}" style="display:inline">@csrf <button>Unsend</button></form>
    </p>
@endforeach
