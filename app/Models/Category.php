<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = ['name'];

    // Relasi Many-to-Many dengan Book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category');  // Relasi many-to-many dengan tabel pivot 'book_category'
    }
}
