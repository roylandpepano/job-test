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
}
