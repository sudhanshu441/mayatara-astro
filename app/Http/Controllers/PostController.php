<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;



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
  'user_id' => session('user_id'),
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
public function like($id)
{
    $post = Post::findOrFail($id);
    $userId = session('user_id');

    // If not logged in
    if (!$userId) {
        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
    }

    // Check if already liked
    $existingLike = $post->likes()
        ->where('user_id', $userId)
        ->first();

    if ($existingLike) {
        // Unlike
        $existingLike->delete();
        $liked = false;
    } else {
        // Like
        $post->likes()->create([
            'user_id' => $userId
        ]);
        $liked = true;
    }

    return response()->json([
        'liked' => $liked,
        'likes_count' => $post->likes()->count()
    ]);
}


public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id')->with('user');
}
public function storecomments(Request $request, $postId)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
        'parent_id' => 'nullable|exists:comments,id'
    ]);

    $userId = session('user_id');

    if (!$userId) {
        // For AJAX request, return JSON error
        if ($request->ajax()) {
            return response()->json(['error' => 'You must be logged in to comment.'], 401);
        }
        return redirect()->back()->with('error', 'You must be logged in to comment.');
    }

    // Create the comment
    $comment = Comment::create([
        'post_id' => $postId,
        'user_id' => $userId,
        'parent_id' => $request->parent_id, // null for parent comment
        'comment' => $request->comment,
    ]);

    // If AJAX, return HTML snippet for the new comment/reply
  if ($request->ajax()) {
    $html = view('partials.comment', compact('comment'))->render();
    return response()->json(['html' => $html]);
}


    return redirect()->back()->with('success', 'Comment added successfully!');
}
public function show(Request $request, $id)
{
    $post = Post::with(['user', 'likes'])->findOrFail($id);

    $sort = $request->get('sort', 'recent');

    $commentsQuery = Comment::with([
            'user',
            'likes',
            'replies.user',
            'replies.likes'
        ])
        ->where('post_id', $post->id)
        ->whereNull('parent_id');

    if ($sort === 'popular') {
        $commentsQuery
            ->withCount('likes')
            ->orderBy('likes_count', 'desc');
    } else {
        $commentsQuery->latest();
    }

    $comments = $commentsQuery->get();

    // ✅ AJAX: render SAME comment blade multiple times
    if ($request->ajax()) {
        $html = '';
        foreach ($comments as $comment) {
            $html .= view('partials.comment', compact('comment'))->render();
        }
        return $html;
    }

    // ✅ Normal page load
    return view('posts.show', compact('post', 'comments'));
}


public function likecomment($id, Request $request)
{
    $userId = session('user_id');
    if (!$userId) {
        if ($request->ajax()) {
            return response()->json(['error' => 'You must be logged in to like.'], 401);
        }
        return redirect()->back()->with('error', 'You must be logged in to like.');
    }

    // Check if the user already liked the comment
    $like = CommentLike::where([
        'comment_id' => $id,
        'user_id'    => $userId
    ])->first();

    if ($like) {
        $like->delete(); // unlike
        $liked = false;
    } else {
        CommentLike::create([
            'comment_id' => $id,
            'user_id'    => $userId
        ]);
        $liked = true;
    }

    $comment = \App\Models\Comment::find($id);
    $likesCount = $comment->likes()->count();

    // If AJAX request, return JSON
    if ($request->ajax()) {
        return response()->json([
            'likesCount' => $likesCount,
            'liked' => $liked
        ]);
    }

    return back();
}


}
