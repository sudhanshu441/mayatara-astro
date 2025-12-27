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
    $userId = session('user_id'); // using session instead of auth()->id()

    if (!$userId) {
        // Redirect if no user in session
        return redirect()->route('login')->with('error', 'Please login to like posts.');
    }

    // Check if the user already liked this post
    $existingLike = $post->likes()->where('user_id', $userId)->first();

    if ($existingLike) {
        // User already liked → remove like (unlike)
        $existingLike->delete();
        $message = 'Post unliked';
    } else {
        // User has not liked yet → create like
        $post->likes()->create([
            'user_id' => $userId,
            'post_id' => $post->id, // optional if your relationship auto-fills post_id
        ]);
        $message = 'Post liked';
    }

    return back()->with('status', $message);
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

        $userId = session('user_id'); // using session user_id

        if (!$userId) {
            return redirect()->back()->with('error', 'You must be logged in to comment.');
        }

        Comment::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'parent_id' => $request->parent_id, // null for parent comment
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function show(Post $post, Request $request)
{
    // Load post relations
    $post->load(['user', 'likes']);

    // Determine sort type: recent (default) or popular
    $sort = $request->get('sort', 'recent');

    // Load comments with user and replies, sorted
    $commentsQuery = $post->comments()->with(['user', 'replies.user']);

    if ($sort === 'popular') {
        // Assuming you have likes_count for comments
        $commentsQuery->withCount('likes')->orderByDesc('likes_count');
    } else {
        $commentsQuery->orderByDesc('created_at'); // recent
    }

    $comments = $commentsQuery->get();

    return view('posts.show', compact('post', 'comments', 'sort'));
}

public function likecomment($id)
{
    $like = CommentLike::where([
        'comment_id' => $id,
        'user_id'    => session('user_id')
    ])->first();

    if ($like) {
        $like->delete(); // unlike
    } else {
        CommentLike::create([
            'comment_id' => $id,
            'user_id'    => session('user_id')
        ]);
    }

    return back();
}

}
