<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = ['book_id', 'member_id', 'borrowed_at', 'returned_at'];

    // Relasi ke buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
