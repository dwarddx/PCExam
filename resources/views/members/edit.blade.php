@extends('layouts.app')

@section('content')
    <h1>Edit Anggota</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama Anggota</label>
            <input type="text" name="name" value="{{ $member->name }}" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $member->email }}" required>
        </div>
        <div>
            <label for="phone">No. Telepon</label>
            <input type="text" name="phone" value="{{ $member->phone }}" required>
        </div>
        <button type="submit">Update</button>
        <a href="{{ route('members.index') }}" class="button cancel" style="margin-top: 10px;">Batal</a>
    </form>
@endsection
