<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'allow_comments',
        'status'
    ];

    protected $casts = [
        'media' => 'array',
        'tags' => 'array',
        'allow_comments' => 'boolean',
    ];
}
