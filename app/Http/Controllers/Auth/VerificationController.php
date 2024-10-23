<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = '/home';

    public function show(Request $request)
    {
        return view('auth.verify'); // View to inform user to verify their email
    }

    public function verify(Request $request, $id, $hash)
    {
        // Find the user by ID
        $user = \App\Models\User::findOrFail($id);

        // Check if the hash matches the user's email and the timestamp
        if (!hash_equals((string) $hash, sha1($user->email . $request->input('timestamp')))) {
            return redirect('/')->with('error', 'Invalid verification link.');
        }

        // Mark the user's email as verified
        $user->markEmailAsVerified();

        // Optionally log in the user
        Auth::login($user);

        return redirect($this->redirectTo)->with('success', 'Email verified successfully!');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectTo);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}
