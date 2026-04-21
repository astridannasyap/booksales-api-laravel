<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Genres</title>
</head>
<body>
    <h1>Book Genres</h1>
    <p>Ini adalah halaman untuk menampilkan daftar genre buku.</p>

    @foreach ($genres as $genre) 
    <ul>
        <li>{{ $genre['name'] }}</li>
        <li>{{ $genre['description'] }}</li>
    </ul>
    @endforeach
</body>
</html>