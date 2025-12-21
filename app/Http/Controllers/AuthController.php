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

    $user = DB::table('users')
        ->where('phone', trim($request->phone))
        ->first();

    // Check phone
    if (!$user) {
        return back()->with('error', 'Phone number not registered')->withInput();
    }

    // 🔴 PLAIN TEXT PASSWORD CHECK (NOT SECURE)
    if ($request->password !== $user->password) {
        return back()->with('error', 'Incorrect password')->withInput();
    }

    // Login success
    session(['user_id' => $user->id]);

    return redirect('/dashboard');
}





}
