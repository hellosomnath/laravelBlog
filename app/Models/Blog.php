<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'feature_image',
        'user_id',
        'author',
        'category_id',
        'tags',
        'published_on',
        'total_views',
        'is_published',
    ];
}
