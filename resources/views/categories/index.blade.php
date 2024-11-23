@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="header">
        <h1>Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="button add">Tambah Kategori</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Pengaturan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('categories.edit', $category->id) }}" class="button edit">Edit</a>
                                <a href="{{ route('categories.destroy', $category->id) }}" 
                                   class="button delete"
                                   onclick="event.preventDefault();
                                           if(confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')) {
                                               document.getElementById('delete-form-{{ $category->id }}').submit();
                                           }">
                                    Hapus
                                </a>
                                <form id="delete-form-{{ $category->id }}" 
                                      action="{{ route('categories.destroy', $category->id) }}" 
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
                        <td colspan="3" class="text-center">Tidak ada data kategori</td>
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