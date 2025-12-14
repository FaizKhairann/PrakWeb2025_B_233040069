<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;

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


Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('post.index');

// Routes model biding dengan slug
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware('auth')->name('posts.show');

//Route untuk register - middleware guest (hanya untuk yang belum login)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

//Route untuk login - middleware guest (hanya  untuk  yang belum login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

//Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

//Route untuk Dashboard posts - hanya untuk yangsudah login 
//index menampilkan semua posts milik user
Route::get('/dashboard', [DashboardPostController::class, 'index'])->middleware([
    'auth',
    'verified'
])->name('dashboard.index');

//Create - Form untuk membuat post baru
Route::get('/dashboard/create', [DashboardPostController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.create');

// Store - Menyimpan post baru
Route::post('/dashboard', [DashboardPostController::class, 'store'])->middleware([
    'auth',
    'verified'
])->name('dashboard.store');

// URL-nya nanti jadi: /dashboard/categories
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')
    ->parameters(['categories' => 'category:slug'])
    ->middleware('auth');

//Show - Menampilkan detail post berdasarkan slug
Route::get('/dashboard/{post:slug}', [DashboardPostController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.show');

// 1. Route untuk Menampilkan Form Edit
Route::get('/dashboard/{post:slug}/edit', [DashboardPostController::class, 'edit'])
    ->middleware('auth')
    ->name('dashboard.edit');

// 2. Route untuk Proses Update Data (Method PUT)
Route::put('/dashboard/{post:slug}', [DashboardPostController::class, 'update'])
    ->middleware('auth')
    ->name('dashboard.update');

// 3. Route untuk Proses Hapus Data (Method DELETE)
Route::delete('/dashboard/{post:slug}', [DashboardPostController::class, 'destroy'])
    ->middleware('auth')
    ->name('dashboard.destroy');


//PERTEMUAN 3
// Route Categories
Route::get('/categories', [CategoryController::class, 'index']);
