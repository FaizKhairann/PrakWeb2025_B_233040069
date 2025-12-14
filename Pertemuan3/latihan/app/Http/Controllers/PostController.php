<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // tugas pertemuan 3 \\\
        /*$posts = Post::all();
        return view('posts', compact('posts'));*/

        $posts = Post::with(['user', 'category'])->get();
        return view('posts', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category']);
        return view('post', compact('post'));
    }
}
