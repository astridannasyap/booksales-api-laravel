<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>
    <h1>Selamat Datang di Halaman Authors</h1>
    <p>Ini adalah halaman untuk menampilkan daftar authors.</p>

    @foreach ($authors as $item) 
    <ul>
        <li>{{ $item['name'] }}</li>
        <li>{{ $item['photo'] }}</li>
        <li>{{ $item['bio'] }}</li>
    </ul>
    @endforeach
</body>
</html>