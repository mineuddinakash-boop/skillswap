<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users',
            'skill'    => 'required|string|max:100',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'skill'    => $request->skill,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration successful!');
    }
}
