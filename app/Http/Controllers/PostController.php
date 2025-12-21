<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'visibility' => 'required|string',
        'slug' => 'nullable|string|max:255|unique:posts,slug',

        'content' => 'required',
        'media.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480',
        'media_alt' => 'nullable|string|max:255',
        'tags' => 'nullable|string',
        'allow_comments' => 'nullable',
    ]);

    $slug = $request->slug ?: Str::slug($request->title);

  $mediaFiles = [];

if ($request->hasFile('media')) {
    foreach ($request->file('media') as $file) {

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('posts'), $filename);

        $mediaFiles[] = 'posts/' . $filename;
    }
}


    $tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

    Post::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'slug' => $slug,
        'category' => $request->category,
        'visibility' => $request->visibility,
        'content' => $request->content,
        'media' => $mediaFiles,
        'media_alt' => $request->media_alt,
        'tags' => $tags,
        'allow_comments' => $request->has('allow_comments'),
        'status' => 'published',
    ]);

    return redirect()->back()->with('success', 'Post published successfully!');
}

}
