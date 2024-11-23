<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Halaman utama yang menampilkan daftar buku, kategori, dan status peminjaman
    public function mainPage(Request $request)
    {
        // Ambil semua kategori untuk filter
        $categories = Category::all();
    
        // Query dasar untuk mengambil buku
        $query = Book::with('categories', 'borrowings.member');
    
        // Filter berdasarkan kategori (jika ada)
        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }
    
        // Filter berdasarkan status peminjaman (jika ada)
        if ($request->filled('status')) {
            if ($request->status == 'borrowed') {
                // Hanya buku yang sedang dipinjam
                $query->whereHas('borrowings', function ($q) {
                    $q->whereNull('returned_at');
                });
            } elseif ($request->status == 'available') {
                // Hanya buku yang tersedia
                $query->whereDoesntHave('borrowings', function ($q) {
                    $q->whereNull('returned_at');
                });
            }
        }
    
        // Ambil data buku berdasarkan query
        $books = $query->get();
    
        // Ambil semua member untuk dropdown peminjaman
        $members = Member::all();
    
        return view('home', compact('books', 'members', 'categories'));
    }

    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::with('categories')->get(); 
        $categories = Category::all(); // Ambil semua kategori
        return view('books.index', compact('books', 'categories'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all();  // Ambil semua kategori untuk dropdown
        return view('books.create', compact('categories'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'categories' => 'required|array',
        ]);

        // Menyimpan data buku
        $book = Book::create($request->only('title', 'author'));

        // Menyimpan relasi many-to-many antara buku dan kategori
        $book->categories()->attach($request->categories);

        // Redirect ke daftar buku
        return redirect()->route('books.index');
    }

    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('books.edit', compact('book', 'categories'));
    }

    // Mengupdate buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'categories' => 'required|array',
        ]);

        // Update data buku
        $book->update($request->only('title', 'author'));

        // Menyinkronkan kategori yang dipilih
        $book->categories()->sync($request->categories);

        // Redirect ke daftar buku
        return redirect()->route('books.index');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete(); // Menghapus buku dari database

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function toggleBorrowing(Book $book, Request $request)
    {
        // Ambil ID member yang dipilih oleh pustakawan dari form
        $memberId = $request->input('member_id');
    
        // Cek apakah member_id valid
        $member = Member::find($memberId);
        if (!$member) {
            return redirect()->route('main.page')->with('error', 'Member tidak ditemukan.');
        }
    
        // Cek apakah buku sudah dipinjam oleh member ini
        $borrowed = $book->borrowings()
                        ->where('member_id', $memberId)
                        ->whereNull('returned_at') // Cek apakah buku belum dikembalikan
                        ->exists();
    
        if ($borrowed) {
            // Kembalikan buku jika member yang dipilih adalah peminjam
            $book->borrowings()
                 ->where('member_id', $memberId)
                 ->whereNull('returned_at')
                 ->update(['returned_at' => now()]);  // Tandai buku sudah dikembalikan
        } else {
            // Pinjam buku jika member yang dipilih belum meminjam
            $book->borrowings()->create([
                'member_id' => $memberId,  // Menggunakan ID member yang dipilih
                'borrowed_at' => now(),  // Menyimpan waktu peminjaman
            ]);
        }
    
        // Redirect ke halaman utama setelah status peminjaman diperbarui
        return redirect()->route('main.page');
    }
    
}
