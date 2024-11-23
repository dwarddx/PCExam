<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function borrowings()
    {
        return $this->hasMany(Book::class);
    }

    public function borrowBook(Book $book)
    {
        if ($book->current_borrower_id !== null) {
            return false;  // Buku sudah dipinjam
        }
        
        $book->update(['current_borrower_id' => $this->id]);

        return true;
    }

    public function returnBook(Book $book)
    {
        if ($book->current_borrower_id !== $this->id) {
            return false;  // Buku bukan milik anggota ini
        }

        $book->update(['current_borrower_id' => null]);

        return true;
    }
}
