@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h1>Tambah Anggota Baru</h1>

    <form method="POST" action="{{ route('members.store') }}">
        @csrf
        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" placeholder="Masukkan nama anggota" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Masukkan email anggota" required>
        </div>

        <div>
            <label for="phone">Telepon</label>
            <input type="text" name="phone" placeholder="Masukkan nomor telepon" required>
        </div>

        <button type="submit" class="button save">Simpan member</button>
        <a href="{{ route('members.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
</div>

<style>
/* Styling form untuk tambah anggota */
.content-wrapper {
    margin: 20px auto;
    max-width: 600px;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.button.save {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.button.save:hover {
    background-color: #575757;
}

.button.cancel {
    background-color: #ccc;
    color: #333;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

.button.cancel:hover {
    background-color: #aaa;
}
</style>
@endsection
