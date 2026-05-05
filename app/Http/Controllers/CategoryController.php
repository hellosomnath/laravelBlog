<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('blogs')->get();
        $latest_blog = Blog::query()->orderBy('published_on', 'desc')->limit(3)->get();
        return view('categories', ['categories' => $categories, 'latest_blog' => $latest_blog]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:categories,category_name'
        ],[
            'category.unique' => 'Category already created'
        ]);

        if ($request->category_id) {
            $category = Category::where('id',$request->category_id)->update(['category_name' => $request->category]);
            return back()->with('success', 'Category updated successfully');
        } else {
            $category = Category::create(['category_name' => $request->category]);
            return back()->with('success', 'Category added successfully');
        }
        
    }

    public function destroy(Category $category)
    {
        $blogs = Blog::query()->where('category_id', $category->id)->count();

        if ($blogs > 0) {
            return back()->with('success', "Can't delete this category as this has blogs added");
        } else {
            $category->delete();
            return back()->with('success', 'Category deleted successfully');
        }
        
    }

    public function addCatAjax(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories',
        ],[
            'category_name' => 'The category field is required',
            'category_name.unique' => 'The category already exist'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();
            return response()->json(['succes' => 'Category created successfully', 'category' => $category]);
        }
        
    }
}
