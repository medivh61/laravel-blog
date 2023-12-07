<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'like_articles', 'article_id', 'user_id');
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->description), 150);
    }
    public function getReadingTime()
    {
        $words = preg_match_all('/\p{L}+/u', $this->description, $matches);
        $russianWordCount = count(array_filter($matches[0], function($word) {
            return preg_match('/\p{Cyrillic}+/u', $word);
        }));
        $mins = ceil($russianWordCount / 180);
        return ($mins < 1) ? 1 : $mins;
    }
}
