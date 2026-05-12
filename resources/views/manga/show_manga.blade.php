<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista MANGA</title>
</head>
<body>
<h1>Catalogo MANGA</h1>
<table>
    <tr>
        <th>TITOLO</th>
        <th>RANK</th>
        <th>IMMAGINE</th>
        <th>VOLUMI</th>
        <th>STATO</th>
    </tr>
    @foreach($mangaList as $manga)
        <tr>
            <td>{{ $manga->title }}</td>
            <td>{{ $manga->rank }}</td>
            <td><img src="{{ $manga->image_url }}" alt="{{ $manga->title }}"></td>
            <td>{{ $manga->volumes }}</td>
            <td>{{ $manga->status }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
