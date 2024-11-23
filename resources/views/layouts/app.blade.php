<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('main.page') }}" style="font-size: 24px; font-weight: bold; color: #fff;">Manajemen Perpustakaan</a>
        <a href="{{ route('books.index') }}">Buku</a>
        <a href="{{ route('categories.index') }}">Kategori</a>
        <a href="{{ route('members.index') }}">Member</a>
    </nav>

    @yield('content')
</body>
</html>
