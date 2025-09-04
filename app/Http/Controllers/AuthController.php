<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show signup form
    public function showSignupForm() {
        return view('signup');
    }

    // Handle signup
    public function signup(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hash for security
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Signup successful! Please login.');
    }







    // Show login form
    public function showLoginForm() {
        return view('login');
    }

    // Handle login
    public function login(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user in session
            $request->session()->put('user', $user);
            return redirect()->route('profile');
        }

        return back()->with('error', 'Invalid credentials!');
    }

    











    // Show edit profile form
public function editProfile(Request $request) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    return view('edit-profile', ['user' => $user]);
}








// Handle profile update
public function updateProfile(Request $request) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id, // ignore own email
    ]);

    DB::table('users')->where('id', $user->id)->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'updated_at' => now(),
    ]);

    // refresh session data
    $updatedUser = DB::table('users')->where('id', $user->id)->first();
    $request->session()->put('user', $updatedUser);

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}

























// Show swap request form
public function showSwapForm(Request $request) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    return view('create-swap');
}








// Handle swap request submission
public function createSwap(Request $request) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    $request->validate([
        'skill_category' => 'required|in:soft skill,hard skill',
        'skill_have' => 'required',
        'skill_source' => 'required',
        'skill_want' => 'required',
    ]);

    DB::table('swap_requests')->insert([
        'user_id' => $user->id,
        'skill_category' => $request->skill_category,
        'skill_have' => $request->skill_have,
        'skill_source' => $request->skill_source,
        'skill_want' => $request->skill_want,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('profile')->with('success', 'Swap request created successfully!');
}



















// Show profile with user's swap requests
public function profile(Request $request) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    // Load this user's swap requests
    $swapRequests = DB::table('swap_requests')->where('user_id', $user->id)->get();

    return view('profile', [
        'user' => $user,
        'swapRequests' => $swapRequests
    ]);
}










// Delete a swap request
public function deleteSwap(Request $request, $id) {
    $user = $request->session()->get('user');

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    DB::table('swap_requests')
        ->where('id', $id)
        ->where('user_id', $user->id) // ensure only owner can delete
        ->delete();

    return redirect()->route('profile')->with('success', 'Swap request removed successfully!');
}
















// Logout
public function logout(Request $request) {
    $request->session()->forget('user'); // remove user from session
    return redirect()->route('home')->with('success', 'Logged out successfully!');
}






//----------------------------------------------



// View all swap requests created by other users
// In app/Http/Controllers/AuthController.php
public function viewSkills(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Please login first!');
    }

    $search = $request->input('search');
    $category = $request->input('category');

    // Top 3 rated users (average rating from chat_history)
    $topRated = DB::table('chat_history')
        ->whereNotNull('rating')
        ->join('users', 'chat_history.chat_with_id', '=', 'users.id')
        ->select('users.id', 'users.name', DB::raw('AVG(chat_history.rating) as avg_rating'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('avg_rating')
        ->limit(3)
        ->get();

    // Build query for swap requests by other users (with username)
    $query = DB::table('swap_requests')
        ->join('users', 'swap_requests.user_id', '=', 'users.id')
        ->where('swap_requests.user_id', '!=', $user->id)
        ->select('swap_requests.*', 'users.name as user_name');

    // Apply search (skill_have or skill_want)
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('swap_requests.skill_have', 'like', "%{$search}%")
              ->orWhere('swap_requests.skill_want', 'like', "%{$search}%");
        });
    }

    // Apply category filter (expects values like "hard skill" or "soft skill")
    if ($category) {
        $query->where('swap_requests.skill_category', $category);
    }

    $swapRequests = $query->get();

    // Add average rating for each swap's owner (from chat_history)
    foreach ($swapRequests as $sr) {
        $sr->average_rating = DB::table('chat_history')
            ->where('chat_with_id', $sr->user_id)
            ->whereNotNull('rating')
            ->avg('rating');
    }

    return view('view-skills', [
        'user' => $user,
        'swapRequests' => $swapRequests,
        'search' => $search,
        'category' => $category,
        'topRated' => $topRated,
    ]);
}















public function addSwapRequest(Request $request, $swapId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Get target swap request
    $swap = DB::table('swap_requests')->where('id', $swapId)->first();
    if (!$swap) return redirect()->back()->with('error', 'Swap request not found.');

    // Insert into user_swaps
    DB::table('user_swaps')->insert([
        'user_id' => $user->id,
        'swap_request_id' => $swap->id,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Send notification to both users
    DB::table('notifications')->insert([
        [
            'from_user' => $user->id,
            'to_user' => $swap->user_id,
            'message' => $user->name . ' wants to swap skills with you.',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'from_user' => $user->id,
            'to_user' => $user->id,
            'message' => 'You sent a swap request to ' . $swap->skill_have . ' owner.',
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);

    return redirect()->route('skills.view')->with('success', 'Swap request sent and notifications created!');
}













// View notifications page
public function viewNotifications(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $notifications = DB::table('notifications')
        ->where('to_user', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('notifications', ['notifications' => $notifications]);
}































// Show all incoming requests for the logged-in user
public function incomingRequests(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Get all user_swaps where swap_request.user_id == $user->id
    $incoming = DB::table('user_swaps')
        ->join('swap_requests', 'user_swaps.swap_request_id', '=', 'swap_requests.id')
        ->join('users', 'user_swaps.user_id', '=', 'users.id')
        ->where('swap_requests.user_id', $user->id)
        ->select(
            'user_swaps.id as user_swap_id',
            'users.id as requester_id',
            'users.name as requester_name',
            'swap_requests.skill_have',
            'swap_requests.skill_source',
            'swap_requests.skill_want',
            'swap_requests.id as swap_request_id'
        )
        ->get();

    return view('incoming-requests', ['requests' => $incoming]);
}

// Reject a request
public function rejectRequest(Request $request, $userSwapId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $swap = DB::table('user_swaps')->where('id', $userSwapId)->first();
    if (!$swap) return redirect()->back()->with('error', 'Request not found.');

    // Get requester id and swap_request details
    $requester = DB::table('users')->where('id', $swap->user_id)->first();
    $swapRequest = DB::table('swap_requests')->where('id', $swap->swap_request_id)->first();

    // Delete request
    DB::table('user_swaps')->where('id', $userSwapId)->delete();

    // Notifications to both users
    DB::table('notifications')->insert([
        [
            'from_user' => $user->id,
            'to_user' => $requester->id,
            'message' => 'Your swap request for ' . $swapRequest->skill_have . ' was rejected by ' . $user->name,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'from_user' => $user->id,
            'to_user' => $user->id,
            'message' => 'You rejected a swap request from ' . $requester->name,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);

    return redirect()->route('requests.incoming')->with('success', 'Request rejected.');
}

// Accept a request
public function acceptRequest(Request $request, $userSwapId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $swap = DB::table('user_swaps')->where('id', $userSwapId)->first();
    if (!$swap) return redirect()->back()->with('error', 'Request not found.');

    $requester = DB::table('users')->where('id', $swap->user_id)->first();

    // Add to accepted_swaps
    DB::table('accepted_swaps')->insert([
        'user1_id' => $requester->id,
        'user2_id' => $user->id,
        'swap_request_id' => $swap->swap_request_id,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Delete the original request from user_swaps
    DB::table('user_swaps')->where('id', $userSwapId)->delete();

    $swapRequest = DB::table('swap_requests')->where('id', $swap->swap_request_id)->first();

    // Notifications to both users
    DB::table('notifications')->insert([
        [
            'from_user' => $user->id,
            'to_user' => $requester->id,
            'message' => 'Your swap request for ' . $swapRequest->skill_have . ' was accepted by ' . $user->name,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'from_user' => $user->id,
            'to_user' => $user->id,
            'message' => 'You accepted a swap request from ' . $requester->name,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);

    return redirect()->route('requests.incoming')->with('success', 'Request accepted.');
}





















// Chat list: show all other users
public function chatList(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Get IDs of users already in history
    $historyUserIds = DB::table('chat_history')
        ->where('user_id', $user->id)
        ->pluck('chat_with_id')
        ->toArray();

    // Show all other users except logged-in user AND users in history
    $users = DB::table('users')
        ->where('id', '!=', $user->id)
        ->whereNotIn('id', $historyUserIds)
        ->get();

    return view('chat-list', ['users' => $users]);
}


// Start chat with specific user
public function startChat(Request $request, $userId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Get chat history between the two users
    $messages = DB::table('chats')
        ->where(function($q) use ($user, $userId) {
            $q->where('from_user', $user->id)->where('to_user', $userId);
        })
        ->orWhere(function($q) use ($user, $userId) {
            $q->where('from_user', $userId)->where('to_user', $user->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    $chatWith = DB::table('users')->where('id', $userId)->first();

    return view('chat', [
        'messages' => $messages,
        'chatWith' => $chatWith
    ]);
}

// Send message
public function sendMessage(Request $request, $userId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $request->validate([
        'message' => 'required'
    ]);

    DB::table('chats')->insert([
        'from_user' => $user->id,
        'to_user' => $userId,
        'message' => $request->message,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('chat.start', $userId);
}



















// Mark chat as done
public function markChatDone(Request $request, $userId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Add to chat_history
    DB::table('chat_history')->insert([
        'user_id' => $user->id,
        'chat_with_id' => $userId,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Delete chat messages between them
    DB::table('chats')
        ->where(function($q) use ($user, $userId) {
            $q->where('from_user', $user->id)->where('to_user', $userId);
        })
        ->orWhere(function($q) use ($user, $userId) {
            $q->where('from_user', $userId)->where('to_user', $user->id);
        })
        ->delete();

    // Redirect back to chat list
    return redirect()->route('chat.list')->with('success', 'Chat marked as done and added to history.');
}


// View history page
public function viewHistory(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $history = DB::table('chat_history')
        ->join('users', 'chat_history.chat_with_id', '=', 'users.id')
        ->where('chat_history.user_id', $user->id)
        ->select('chat_history.id', 'users.name', 'chat_history.created_at', 'chat_history.rating')
        ->orderBy('chat_history.created_at', 'desc')
        ->get();

    return view('history', ['history' => $history]);
}


























public function rateHistory(Request $request, $historyId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    $request->validate([
        'rating' => 'required|integer|min:1|max:5'
    ]);

    DB::table('chat_history')
        ->where('id', $historyId)
        ->where('user_id', $user->id)
        ->update([
            'rating' => $request->rating,
            'updated_at' => now()
        ]);

    return redirect()->route('history.view')->with('success', 'Rating submitted successfully!');
}

















public function addSwap(Request $request, $swapRequestId) {
    $user = $request->session()->get('user');
    if (!$user) return redirect()->route('login.form')->with('error', 'Please login first!');

    // Check if the user already added this swap
    $exists = DB::table('user_swaps')
        ->where('user_id', $user->id)
        ->where('swap_request_id', $swapRequestId)
        ->exists();

    if (!$exists) {
        DB::table('user_swaps')->insert([
            'user_id' => $user->id,
            'swap_request_id' => $swapRequestId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Optional: send notifications to both users
        $swap = DB::table('swap_requests')->where('id', $swapRequestId)->first();
        // Notification logic here if implemented
    }

    return redirect()->route('skills.view')->with('success', 'Swap added successfully!');

}







}
