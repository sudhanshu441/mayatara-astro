<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    public $timestamps = false;

    protected $fillable = ['community_id','user_id'];
}
