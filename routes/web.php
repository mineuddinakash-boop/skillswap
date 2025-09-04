<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Signup
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Profile
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

// Edit Profile
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/edit', [AuthController::class, 'updateProfile'])->name('profile.update');

// Swap Request
Route::get('/swap/create', [AuthController::class, 'showSwapForm'])->name('swap.form');
Route::post('/swap/create', [AuthController::class, 'createSwap'])->name('swap.create');

// delete created dwap request
Route::post('/swap/delete/{id}', [AuthController::class, 'deleteSwap'])->name('swap.delete');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// View all available skills (swap requests by other users)
Route::get('/skills', [AuthController::class, 'viewSkills'])->name('skills.view');

// Send swap request (Add) from view-skills page
Route::post('/swap/request/{id}', [AuthController::class, 'addSwapRequest'])->name('swap.add');

// View notifications
Route::get('/notifications', [AuthController::class, 'viewNotifications'])->name('notifications.view');

// Incoming requests page
Route::get('/incoming-requests', [AuthController::class, 'incomingRequests'])->name('requests.incoming');

// Accept or Reject
Route::post('/incoming-requests/accept/{id}', [AuthController::class, 'acceptRequest'])->name('requests.accept');
Route::post('/incoming-requests/reject/{id}', [AuthController::class, 'rejectRequest'])->name('requests.reject');

// Chat list page
Route::get('/chat', [AuthController::class, 'chatList'])->name('chat.list');

// Start chat with a user
Route::get('/chat/{userId}', [AuthController::class, 'startChat'])->name('chat.start');

// Send message
Route::post('/chat/send/{userId}', [AuthController::class, 'sendMessage'])->name('chat.send');

// Mark chat as done
Route::post('/chat/done/{userId}', [AuthController::class, 'markChatDone'])->name('chat.done');

// History page
Route::get('/history', [AuthController::class, 'viewHistory'])->name('history.view');

//rating submission
Route::post('/history/rate/{id}', [AuthController::class, 'rateHistory'])->name('history.rate');

// Add a swap (user selects someone else's skill)
Route::post('/swap/add/{swapRequestId}', [AuthController::class, 'addSwap'])->name('add.swap');




