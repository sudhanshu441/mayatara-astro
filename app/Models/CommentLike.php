<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
    ];

    // Like belongs to a comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
