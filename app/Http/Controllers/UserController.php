<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home()
    {
        $popular_blogs = Blog::orderBy('total_views', 'desc')->limit(4)->get();
        $latest_blog = Blog::orderBy('published_on', 'desc')->limit(4)->get();

        return view('home', ['popular_blogs' => $popular_blogs, 'latest_blog' => $latest_blog]);
    }
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

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'username' => 'required',
            'email' => [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($user->id),
                       ],
            'new_password' => ($request->new_password) ? [
                            'required',
                            'same:confirm_password',
                            Password::min(6)->letters()->symbols()->numbers()
                        ] : "",
        ],
        [
            'username' => 'The name field is required.'
        ]);
        
        $user->name = $request->username;
        $user->email = $request->email;

        $password = $request->current_password;
        if($request->new_password) {
            if (Hash::check($password, $user->password)) {
                $user->password = Hash::make($request->new_password);

                $user->save();
                return redirect('/logout');
            } else {
                return back()->withErrors(['password' => 'Invalid credential']);
            }
        }

        $user->save();
        return redirect('/user/profile')->with('success', 'Profile updated');
    }
}
