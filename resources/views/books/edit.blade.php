@extends('layouts.app')

@section('content')
    <h1>Edit Buku</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Judul Buku</label>
            <input type="text" name="title" value="{{ $book->title }}" required>
        </div>

        <div>
            <label for="author">Penulis Buku</label>
            <input type="text" name="author" value="{{ $book->author }}" required>
        </div>

        <div>
            <label>Pilih Kategori:</label><br>
            @foreach($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                        @if(in_array($category->id, $book->categories->pluck('id')->toArray())) checked @endif> 
                        {{ $category->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">Update Buku</button>
        <a href="{{ route('books.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
@endsection
