<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myBlogs()
    {
        $userId = auth()->user()->id;
        $blogs = Blog::where('user_id', $userId)->orderBy('id', 'desc')->paginate(5);
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        $categories = Category::withCount('blogs')->get();
        return view('user.my_blogs', [
                                    'blogs' => $blogs,
                                    'categories' => $categories,
                                    'latest_blog' => $latest_blog
                                ]);
    }
}
