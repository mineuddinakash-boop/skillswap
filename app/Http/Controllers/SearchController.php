<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'skill' => 'required|string',
        ]);

        $results = User::where('skill', 'like', '%' . $request->skill . '%')
                    ->where('id', '!=', Auth::id()) // exclude current user
                    ->get();

        return view('search-results', ['results' => $results]);
    }

    public function showAllSkills()
    {
        $results = User::where('id', '!=', Auth::id())->get(); // All users except logged-in one
        return view('all-skills', ['results' => $results]);
    }
}
