<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route Home
Route::get('/', function () {
    return view('home');
});


Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route Categories
Route::get('/categories', [CategoryController::class, 'index']);
