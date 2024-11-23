@extends('layouts.app')

@section('content')
    <h1>Edit Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
        </div>
        <button type="submit">Update</button>
        <a href="{{ route('categories.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
@endsection
