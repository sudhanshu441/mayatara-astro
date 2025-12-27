<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'comment',
    ];

    /* ------------------------
     | Relationships
     |-------------------------*/

    // Comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent comment (for replies)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Replies to this comment (LATEST FIRST)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->latest();
    }

    // Likes on this comment
    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    /* ------------------------
     | Helpers
     |-------------------------*/

    // Total likes count
    public function likesCount()
    {
        return $this->likes()->count();
    }

    // Check if user liked this comment
    public function isLikedBy($userId)
    {
        return $this->likes()
            ->where('user_id', $userId)
            ->exists();
    }
}
