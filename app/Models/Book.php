<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'current_borrower_id'];

    // Relasi Many-to-Many dengan kategori
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');  // 'book_category' adalah nama pivot table
    }

    // Relasi One-to-Many dengan Member (Anggota yang meminjam buku)
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}