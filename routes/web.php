<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogSearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('login');

// blogs
Route::resource('blogs', BlogController::class);

Route::get('category/{category:category_name}', [BlogSearchController::class, 'searchByCategory']);
Route::get('tags/{tag}', [BlogSearchController::class, 'searchByTag']);
Route::get('blog-search/', [BlogSearchController::class, 'searchByText']);

// authentication
Route::post('signup', [AuthController::class, 'signup'])->middleware('guest');
Route::post('signin', [AuthController::class, 'signin'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

//user
Route::get('/user/my-blogs', [UserController::class, 'myBlogs'])->middleware('auth');
Route::get('/user/profile', [UserController::class, 'profile'])->middleware('auth');
Route::post('/user/profile/{user}', [UserController::class, 'updateProfile'])->middleware('auth');