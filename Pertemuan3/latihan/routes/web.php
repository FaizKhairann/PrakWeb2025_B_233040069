<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//contoh route untuk menampilkan route
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

//Route untuk memanggil method di PostController
Route::get('post', [PostController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
