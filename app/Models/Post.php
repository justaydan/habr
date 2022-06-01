<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = ['title', 'link', 'authorId'];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'postId', 'id')->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId', 'id');
    }
}
