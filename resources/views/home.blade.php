@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="header">
        <h1>Daftar Buku & Peminjam</h1>
    </div>

    <!-- Filter Buku -->
    <form action="{{ route('main.page') }}" method="GET" style="margin-bottom: 20px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px; align-items: center;">
            <!-- Filter Kategori -->
            <div>
                <label for="category_id">Filter Kategori:</label>
                <select name="category_id" id="category_id">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Status Peminjaman -->
            <div>
                <label for="status">Status Peminjaman:</label>
                <select name="status" id="status">
                    <option value="">Semua</option>
                    <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                </select>
            </div>

            <!-- Tombol Filter -->
            <div>
                <button type="submit" class="button filter">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Buku -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Status Peminjaman</th>
                    <th>Pengaturan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ implode(', ', $book->categories->pluck('name')->toArray()) }}</td>
                        <td>
                            @if ($book->borrowings->where('returned_at', null)->count() > 0)
                                <span class="badge badge-danger">Dipinjam</span>
                            @else
                                <span class="badge badge-success">Tersedia</span>
                            @endif
                        </td>
                        <td>
                            @if ($book->borrowings->where('returned_at', null)->count() > 0)
                                <!-- Buku Dipinjam, Menampilkan Nama Member yang Meminjam -->
                                @php
                                    $borrowedBy = $book->borrowings->where('returned_at', null)->first()->member;
                                @endphp
                                <p><strong>Dipinjam oleh:</strong> {{ $borrowedBy->name }}</p>
                                <form action="{{ route('books.toggleBorrowing', $book->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $borrowedBy->id }}">
                                    <button type="submit" class="button return">Kembalikan Buku</button>
                                </form>
                            @else
                                <!-- Buku Tersedia, Memilih Member untuk Pinjam -->
                                <form action="{{ route('books.toggleBorrowing', $book->id) }}" method="POST">
                                    @csrf
                                    <div>
                                        <select name="member_id" required>
                                            <option value="">Pilih Member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="button borrow">Pinjam Buku</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
/* Tambahkan styling untuk tombol Pinjam dan Kembalikan */
.button.borrow {
    background-color: #4CAF50;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
}

.button.borrow:hover {
    background-color: #45a049;
}

.button.return {
    background-color: #f44336;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
}

.button.return:hover {
    background-color: #d32f2f;
}

.badge {
    padding: 5px 10px;
    border-radius: 12px;
    color: white;
}

.badge-success {
    background-color: #4CAF50;
}

.badge-danger {
    background-color: #f44336;
}
</style>
@endsection
