<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'parent_id',
        'username',
        'email',
        'website',
        'body',
    ];

    public function subcomment() {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
