<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();  // Ambil semua kategori
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Menambah kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Membuat kategori baru
        Category::create($request->only('name'));

        // Redirect ke halaman daftar kategori
        return redirect()->route('categories.index');
    }

    // Menampilkan form edit kategori
    public function edit(Category $category)
    {
        // Mengirim data kategori yang akan diedit ke form
        return view('categories.edit', compact('category'));
    }

    // Mengupdate kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Mengupdate kategori yang dipilih
        $category->update($request->only('name'));

        // Redirect ke halaman daftar kategori setelah update
        return redirect()->route('categories.index');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        // Menghapus kategori yang dipilih
        $category->delete();

        // Redirect ke halaman daftar kategori setelah dihapus
        return redirect()->route('categories.index');
    }
}
