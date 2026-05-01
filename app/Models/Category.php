<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['category_name'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getCategoriesBlogCount()
    {
        $categories = DB::table('categories')
                    ->leftJoin('blogs', 'categories.id', '=', 'blogs.category_id')
                    ->select('categories.category_name', DB::raw('count(blogs.id) as blogs_count'))
                    ->groupBy('categories.id', 'categories.category_name')
                    ->get();
        return $categories;
    }
}
