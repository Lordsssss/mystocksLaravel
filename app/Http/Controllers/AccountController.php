<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account'); // Show the account edit form
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|url|max:255', // Validate the URL
        ]);

        $user = auth()->user();

        // Update user information
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the new password
        }

        if ($request->filled('profile_image')) {
            $user->profile_image = $request->profile_image; // Save the image URL in the database
        }

        $user->save(); // Save the updated user information

        return redirect()->route('account')->with('success', 'Profile updated successfully.');
    }
}

