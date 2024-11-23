@extends('layouts.app')

@section('content')
    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" required>
        </div>
        <button type="submit">Tambah Kategori</button>
        <a href="{{ route('categories.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
@endsection
