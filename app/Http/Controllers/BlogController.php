<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        switch ($request->query('sort')) {
            case 'sbpa':
                $sort = 'sbpa';
                $sortBy = 'published_on';
                $sortType = 'asc';
                break;

            case 'sbpd':
                $sort='sbpd';
                $sortBy = 'published_on';
                $sortType = 'desc';
                break;

            case 'sbvd':
                $sortBy = 'total_views';
                $sortType = 'desc';
                $sort = 'sbvd';
                break;

            case 'sbva':
                $sortBy = 'total_views';
                $sortType = 'asc';
                $sort = 'sbva';
                break;

            case 'sbaa':
                $sortBy = 'author';
                $sortType = 'asc';
                $sort = 'sbaa';
                break;

            case 'sbad':
                $sortBy = 'author';
                $sortType = 'desc';
                $sort = 'sbad';
                break;
            
            default:
                $sortBy = 'published_on';
                $sortType = 'desc';
                $sort = 'sbpd';
                break;
        }

        $categories = Category::withCount('blogs')->get();

        $blogs = Blog::query()->where('is_published', 1)->orderBy($sortBy, $sortType)->orderBy('id', 'desc')->paginate(5);
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        
        return view('blogs.index', ['blogs' => $blogs,'categories' => $categories, 'latest_blog' => $latest_blog, 'sort' => $sort]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()) {
            return redirect('/blogs');
        }
        $categories = Category::all();
        return view('blogs.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'published_on' => 'required',
        ],
        [
            'category_id' => 'The category field is required.'
        ]);

        $formFields['published_on'] = $request->published_on ? date('Y-m-d', strtotime($request->published_on)) : date('Y-m-d');
        $formFields['tags'] = $request->tags;
        $formFields['is_published'] = $request->is_published;
        if ($request->hasFile('feature_image')) {
            $formFields['feature_image'] = $request->file('feature_image')->store('uploads', 'feature_image');
        }

        $blog = Blog::create($formFields);
        session()->flash('success', 'Blog created successfully');

        return redirect('user/my-blogs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->update(['total_views' => $blog->total_views+1]);
        $category = Category::query()->where('id', $blog->category_id)->first();
        $blog->category_name = $category->category_name;
        $categories = Category::withCount('blogs')->get();

        $comments = Comment::where(['parent_id'=> 0, 'blog_id' => $blog->id])->with('subcomment')->paginate(5);
        $com_count = Comment::where(['parent_id'=> 0, 'blog_id' => $blog->id])->count();

        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        $popular_blogs = Blog::query()->orderBy('total_views', 'desc')->limit(3)->get();
        return view('blogs.show', 
            [
                'blog' => $blog,
                'categories' => $categories, 
                'latest_blog' => $latest_blog, 
                'popular_blogs' => $popular_blogs, 
                'comments' => $comments, 
                'total_comments' => $com_count
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if(!auth()->user()) {
            return redirect('/blogs');
        }
        $categories = Category::all();
        return view('blogs.edit', ['blog' => $blog, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'published_on' => 'required',
        ],
        [
            'category_id' => 'The category field is required.'
        ]);

        $formFields['published_on'] = $request->published_on ? date('Y-m-d', strtotime($request->published_on)) : date('Y-m-d');
        $formFields['tags'] = $request->tags;
        $formFields['is_published'] = $request->is_published;
        if ($request->hasFile('feature_image')) {
            if($blog->feature_image) {
                unlink(public_path($blog->feature_image));
            }
            $formFields['feature_image'] = $request->file('feature_image')->store('uploads', 'feature_image');
        }

        $blog->update($formFields);
        session()->flash('success', 'Blog updated successfully');

        return redirect('user/my-blogs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->feature_image) {
            unlink(public_path($blog->feature_image));
        }

        $blog->delete();
        session()->flash('success', 'Blog deleted successfully');
        return redirect('user/my-blogs');
    }
}
