<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::get('/profile/edit', function () {
    return view('edit-profile', ['user' => Auth::user()]);
})->middleware('auth')->name('profile.edit');

Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth')->name('profile.update');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'submitForm'])->name('register.submit');



Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/skills', [App\Http\Controllers\SearchController::class, 'showAllSkills'])->name('skills');

Route::get('/dashboard', [App\Http\Controllers\ProfileController::class, 'dashboard'])->name('dashboard');
Route::get('/chat', fn() => view('chat'))->name('chat'); // simple placeholder view

Route::post('/send-request/{toUserId}', [App\Http\Controllers\SkillRequestController::class, 'send'])->name('send-request');

Route::post('/request/{id}/{action}', [SkillRequestController::class, 'respond'])->name('request-action'); // accept/reject
Route::post('/unsend-request/{id}', [SkillRequestController::class, 'unsend'])->name('unsend-request');
