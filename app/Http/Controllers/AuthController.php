<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\PdoUser;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $pdoUser = new PdoUser();
        // XSS Protection: Sanitize the name input to prevent Cross-Site Scripting
        $sanitizedName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        // Password Hashing: Securely hash the password before storing
        $hashedPassword = Hash::make($request->password); // uses password_hash() internally
        $pdoUser->create(
            $sanitizedName,
            strtolower($request->email),
            $hashedPassword
        );

        // Fetch the user back for session (simulate auto-increment id fetch)
        $user = $pdoUser->findByEmail(strtolower($request->email));
        // Session Management: Store user info and last activity timestamp in session
        $request->session()->put('user', [
            'id'            => $user['id'],
            'name'          => $user['name'],
            'email'         => $user['email'],
            'last_activity' => time(),
        ]);

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $pdoUser = new PdoUser();
        $user = $pdoUser->findByEmail($request->email);

        // Password Verification: Securely verify the password using password_verify() via Hash::check()
        if (!$user || !Hash::check($request->password, $user['password'])) {
            return back()->with('error', 'Invalid credentials.');
        }

        // Session Management: Store user info and last activity timestamp in session
        $request->session()->put('user', [
            'id'            => $user['id'],
            'name'          => $user['name'],
            'email'         => $user['email'],
            'last_activity' => time(),
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Session Management: Invalidate the session on logout
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    /**
     * Handle sending a password reset link to the given email address.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate a token (for demo, use random string; in production, use a secure method and store in DB)
        $token = bin2hex(random_bytes(32));

        // Example reset link (would point to a reset form in a real app)
        $resetLink = url('/password/reset/' . $token . '?email=' . urlencode($request->email));

        // Simulate sending email by flashing the link to the session (for demo/testing)
        return back()->with('status', 'A password reset link has been sent to your email. (Demo: ' . $resetLink . ')');
    }
}
