<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogSearchController extends Controller
{
    public function searchByCategory(Category $category)
    {
        $cat = new Category();
        $categories = $cat->getCategoriesBlogCount();

        $blogs = Blog::query()->where('is_published', 1)->where('category_id', $category->id)->orderBy('published_on', 'desc')->paginate(5);
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        return view('blogs.index', ['blogs' => $blogs,'categories' => $categories, 'latest_blog' => $latest_blog]);
    }

    public function searchByTag($tag)
    {
        $categories = DB::table('categories')
                    ->leftJoin('blogs', 'categories.id', '=', 'blogs.category_id')
                    ->select('categories.category_name', DB::raw('count(categories.id) as blogs_count'))
                    ->groupBy('categories.id', 'categories.category_name')
                    ->get();

        $blogs = Blog::query()->where('is_published', 1)->where('tags', 'LIKE', "%".$tag."%")->orderBy('published_on', 'desc')->paginate(5);
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        return view('blogs.index', ['blogs' => $blogs,'categories' => $categories, 'latest_blog' => $latest_blog]);
    }

    public function searchByText(Request $request)
    {
        $searchTerm = $request->query('search');
        $categories = Category::withCount('blogs')->get();

        $blogs = Blog::query()
                        ->where('is_published', 1)
                        ->where('title', 'LIKE', "%".$searchTerm."%")
                        ->orWhere('content', 'LIKE', "%".$searchTerm."%")
                        ->orWhere('author', 'LIKE', "%".$searchTerm."%")
                        ->orderBy('published_on', 'desc')
                        ->paginate(2);
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        return view('blogs.index', ['blogs' => $blogs,'categories' => $categories, 'latest_blog' => $latest_blog, 'searchTerm' => $searchTerm]);
    }
}
