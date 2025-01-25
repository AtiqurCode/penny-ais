<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.users', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Prepare additional fields
        $request->merge([
            'password' => bcrypt("password"), // Default password
            'email_verified_at' => now(), // Mark email as verified
        ]);

        // Create the user
        $user = User::create($request->all());

        // Create the user's team
        Team::create([
            'user_id' => $user->id, // Associate the team with the newly created user
            'name' => $user->name . "'s Team",
            'personal_team' => true,
        ]);

        // Redirect to the users listing page
        return redirect()->route('users')->with('success', 'User and team created successfully!');
    }



    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.users-show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users');
    }
}
