<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SkillRequest; // Add this line

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'skill' => 'required|string|max:100',
        ]);

        $user->update($request->only(['name', 'phone', 'email', 'skill']));

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }

    public function dashboard()
    {
        $incoming = SkillRequest::where('to_user_id', Auth::id())->get();
        $outgoing = SkillRequest::where('from_user_id', Auth::id())->get();

        return view('dashboard', compact('incoming', 'outgoing'));
    }
}