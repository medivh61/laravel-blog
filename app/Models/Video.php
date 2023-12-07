<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(VideoComment::class);
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'like_videos', 'video_id', 'user_id');
    }

}
