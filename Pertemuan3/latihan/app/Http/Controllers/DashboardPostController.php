<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menggunakan user_id dari user yang sedang login
        $posts = Post::where('user_id', Auth::id());

        //fitur search
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        //menampilkan 5 data per halaman dengan pagination
        return view('dashboard.index', ['posts' => $posts->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Memastikan id ada di tabel categories
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Nullable, harus gambar, max 2MB
        ], [
            // Custom Messages (Pesan Error Bahasa Indonesia)
            'title.required' => 'Field Title wajib diisi',
            'title.max' => 'Field Title tidak boleh lebih dari 255 karakter',
            'category_id.required' => 'Field Category wajib dipilih',
            'category_id.exists' => 'Category yang dipilih tidak valid',
            'excerpt.required' => 'Field Excerpt wajib diisi',
            'body.required' => 'Field Content wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // 2. Cek Jika Validasi Gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Mengirimkan pesan error kembali ke form
                ->withInput();           // Mengirimkan data yang sudah diinput (biar gak ngisi ulang)
        }

        $slug = Str::slug($request->title);

        //pastikan slug unique - jika sudah ada, tambahkan angak di belakang
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        //create post
        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image' => $imagePath, //
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Aturan validasi dasar
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];

        // Cek Slug: Kalau judulnya diganti, slug baru harus dicek uniknya
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // Cek Gambar: Kalau upload gambar baru, hapus yang lama
        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['user_id'] = Auth::id();
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Post berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // 1. Cek apakah ada gambar? Kalau ada, hapus dari folder storage
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // 2. Hapus data dari database
        $post->delete();

        // 3. Balikin ke halaman index dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Post berhasil di hapus!');
    }
}
