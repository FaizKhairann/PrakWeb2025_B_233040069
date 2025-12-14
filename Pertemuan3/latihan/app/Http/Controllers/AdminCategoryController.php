<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Bikin slug otomatis dari nama
        $validatedData['slug'] = Str::slug($request->name);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        // Kalau namanya berubah, cek unique lagi
        if ($request->name != $category->name) {
            $rules['name'] = 'required|unique:categories|max:255';
        }

        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::slug($request->name);

        Category::where('id', $category->id)->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category berhasil di perbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('categories.index')->with('success', 'Category berhasil di hapus!');
    }
}
