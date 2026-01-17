<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'category',
        'visibility',
        'content',
        'media',
        'media_alt',
        'tags',
        'community_id',
        'allow_comments',
        'status'
    ];

    protected $casts = [
        'media' => 'array',
        'tags' => 'array',
        'allow_comments' => 'boolean',
    ];

    // Relationship to likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relationship to comments (only parent comments)
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    // Optional: all comments including replies
    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship to the user who posted
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
