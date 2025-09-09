<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\PdoUser;

class UserController extends Controller
{
    public function index()
    {
        $pdoUser = new PdoUser();
        $users = $pdoUser->getAll(10, 0);
        return view('dashboard.index', ['users' => $users]);
    }

    public function dashboard()
    {
        $users = User::paginate(10);
        return view('dashboard.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $pdoUser = new PdoUser();
        // XSS Protection: Sanitize the name input to prevent Cross-Site Scripting
        // Password Hashing: Securely hash the password before storing
        $pdoUser->create(
            htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8'),
            strtolower($request->email),
            Hash::make($request->password) // uses password_hash() internally
        );

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('dashboard.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $pdoUser = new PdoUser();
        // XSS Protection: Sanitize the name input to prevent Cross-Site Scripting
        $name = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $email = strtolower($request->email);
        $password = null;
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            // Password Hashing: Securely hash the password before updating
            $password = Hash::make($request->password); // uses password_hash() internally
        }
        $pdoUser->update($user->id, $name, $email, $password);

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $pdoUser = new PdoUser();
        $pdoUser->delete($user->id);
        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }
}
