<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['user_id', 'name', 'icon'];

    // Font Awesome icon accessor
    public function getFaIconAttribute()
    {
        return 'fa-solid fa-' . $this->icon;
    }
       public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function joinRequests()
    {
        return $this->hasMany(CommunityJoinRequest::class);
    }
}

