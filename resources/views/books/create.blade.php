@extends('layouts.app')

@section('content')
    <h1>Tambah Buku Baru</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Judul Buku</label>
            <input type="text" name="title" placeholder="Masukkan judul buku" required>
        </div>

        <div>
            <label for="author">Penulis Buku</label>
            <input type="text" name="author" placeholder="Masukkan nama penulis" required>
        </div>

        <div>
            <label>Pilih Kategori:</label><br>
            @foreach($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"> 
                    {{ $category->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">Simpan Buku</button>
        <a href="{{ route('books.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
@endsection
