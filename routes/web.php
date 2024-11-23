<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;

// Main page yang menampilkan tabel buku
Route::get('/', [BookController::class, 'mainPage'])->name('main.page');

// Rute resource untuk Buku, Kategori, dan Anggota
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('members', MemberController::class);
Route::post('books/{book}/toggle-borrowing', [BookController::class, 'toggleBorrowing'])->name('books.toggleBorrowing');
