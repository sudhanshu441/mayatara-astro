<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'required|string',
    ]);

    Community::create([
        'user_id' => session('user_id'), // or auth()->id()
        'name'    => $request->name,
        'icon'    => $request->icon,
    ]);

    return back()->with('success', 'Community created!');
}


public function show(Request $request, $communityId)
{
    $query = Post::where('status', 'published')
                 ->where('visibility', 'public')
                 ->where('community_id', $communityId) // only posts for this community
                 ->with('user'); // eager load user for category

    // ----- SORTING -----
    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'newest':
                $query->latest(); // created_at DESC
                break;

            case 'popular':
                $query->withCount('likes')->orderBy('likes_count', 'desc');
                break;

            case 'trending':
                $query->withCount('comments')->orderBy('comments_count', 'desc');
                break;
        }
    } else {
        $query->latest();
    }

    // ----- USER CATEGORY FILTER -----
    if ($request->has('topic') && !empty($request->topic)) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('category', $request->topic);
        });
    }

    $posts = $query->get(); // this will now return only posts for the community

    return view('dashboard', compact('posts'));
}











}
