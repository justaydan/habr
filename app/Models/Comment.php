<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['content', 'postId', 'authorId', 'parentId'];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parentId', 'id')->with('author');
    }
}
