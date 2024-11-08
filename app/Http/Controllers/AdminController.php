<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with user information.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all users except the current admin
        $users = User::where('user_id', '!=', auth()->user()->user_id)->get();

        return view('admin.dashboard', compact('users'));
    }

    /**
     * Upgrade a user to moderator.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upgradeToModerator($user_id)
    {
        $user = User::findOrFail($user_id);

        // Check if the user is already a moderator or admin
        if ($user->role <= 1) {
            return redirect()->back()->with('message', 'User is already a moderator or admin.');
        }

        // Upgrade the user to moderator
        $user->role = 1;
        $user->save();

        return redirect()->back()->with('message', 'User upgraded to moderator successfully.');
    }

    public function demoteToUser($user_id)
    {
        $user = User::findOrFail($user_id);

        // Ensure the user is currently a moderator before demoting
        if ($user->role === 1) {
            $user->role = 2; // Set role to normal user
            $user->save();

            return redirect()->back()->with('message', __('messages.demoted_successfully'));
        }

        return redirect()->back()->with('message', __('messages.not_moderator'));
    }
}
