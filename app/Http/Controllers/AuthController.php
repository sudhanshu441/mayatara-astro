<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Post;

class AuthController extends Controller
{
    public function login()
    {
        // Static view for now
        return view('auth.login');
    }

  public function dashboard()
    {
        $posts = Post::where('status', 'published')
        ->where('visibility', 'public')
        ->latest()
        ->get();

        return view('dashboard', compact('posts'));
    }

public function loginSubmit(Request $request)
{
    $request->validate([
        'phone' => 'required|digits:10',
        'password' => 'required',
    ]);

    // Get user by phone
    $user = DB::table('users')
        ->where('phone', trim($request->phone))
        ->first();

    // Phone not found
    if (!$user) {
        return back()
            ->with('error', 'Phone number not registered')
            ->withInput();
    }

    // Secure password check (HASHED)
    if (!Hash::check($request->password, $user->password)) {
        return back()
            ->with('error', 'Incorrect password')
            ->withInput();
    }

    // Store user in session
    session([
        'user_id' => $user->id,
        'user_role' => $user->role,
        'user_name' => $user->name,
    ]);

    // Role-based redirect
    if ($user->role === 'astrologer') {
        return redirect()->route('dashboard');
    }

    return redirect()->route('dashboard');
}

public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'role' => 'required|in:user,astrologer',
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
'expertise' => 'nullable',
            'experience_years' => 'nullable',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => $request->role,
            'expertise' => $request->role === 'astrologer' ? $request->expertise : null,
            'experience_years' => $request->role === 'astrologer' ? $request->experience_years : null,
            'bio' => $request->role === 'astrologer' ? $request->bio : null,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }



}
