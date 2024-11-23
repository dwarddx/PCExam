@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Header dengan tombol Tambah Anggota -->
    <div class="header">
        <h1>Daftar Anggota</h1>
        <a href="{{ route('members.create') }}" class="button add">Tambah Anggota</a>
    </div>

    <!-- Tabel Daftar Anggota -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Pengaturan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('members.edit', $member->id) }}" class="button edit">Edit</a>
                                <a href="{{ route('members.destroy', $member->id) }}" 
                                   class="button delete"
                                   onclick="event.preventDefault();
                                           if(confirm('Apakah Anda yakin ingin menghapus anggota {{ $member->name }}?')) {
                                               document.getElementById('delete-form-{{ $member->id }}').submit();
                                           }">
                                    Hapus
                                </a>
                                <form id="delete-form-{{ $member->id }}" 
                                      action="{{ route('members.destroy', $member->id) }}" 
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
                        <td colspan="5" class="text-center">Tidak ada data anggota</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* Styling tabel dan daftar anggota */
.content-wrapper {
    margin: 20px auto;
    max-width: 1000px;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 24px;
}

.header .button.add {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.header .button.add:hover {
    background-color: #45a049;
}

.table-responsive {
    overflow-x: auto;
    margin-top: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tr:hover {
    background-color: #f1f1f1;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.button.edit {
    background-color: #007BFF;
    color: white;
}

.button.edit:hover {
    background-color: #0056b3;
}

.button.delete {
    background-color: #f44336;
    color: white;
}

.button.delete:hover {
    background-color: #d32f2f;
}
</style>
@endsection
