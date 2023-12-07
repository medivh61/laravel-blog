<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'like_notes', 'note_id', 'user_id');
    }

}
