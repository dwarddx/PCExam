@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="header">
        <h1>Daftar Buku</h1>
        <a href="{{ route('books.create') }}" class="button add">Tambah Buku</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kategori</th> <!-- Kolom Kategori Buku -->
                    <th>Pengaturan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <!-- Menampilkan daftar kategori -->
                            {{ $book->categories->pluck('name')->join(', ') }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('books.edit', $book->id) }}" class="button edit">Edit</a>
                                <a href="{{ route('books.destroy', $book->id) }}" 
                                   class="button delete"
                                   onclick="event.preventDefault();
                                           if(confirm('Apakah Anda yakin ingin menghapus buku {{ $book->title }}?')) {
                                               document.getElementById('delete-form-{{ $book->id }}').submit();
                                           }">
                                    Hapus
                                </a>
                                <form id="delete-form-{{ $book->id }}" 
                                      action="{{ route('books.destroy', $book->id) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data buku</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.table-responsive {
    overflow-x: auto;
    margin-top: 20px;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.button {
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    text-decoration: none;
}

.text-center {
    text-align: center;
    padding: 20px;
    color: #666;
}

/* Responsive styling */
@media (max-width: 768px) {
    .table td {
        white-space: nowrap;
    }
    
    .header {
        flex-direction: column;
        gap: 10px;
    }
    
    .header .button {
        width: auto;
    }
}
</style>
@endsection
