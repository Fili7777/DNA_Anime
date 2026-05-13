<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Anime</title>
</head>
<body>
    <h1>Catalogo Anime</h1>
    <h2>Ciao scegli pure un anime da mettere nei preferiti!</h2>
    <table>
        <tr>
            <th>TITOLO</th>
            <th>RANK</th>
            <th>IMMAGINE</th>
            <th>EPISODI</th>
            <th>STATO</th>
        </tr>
    @foreach($animeList as $anime)
        <tr>
            <td><a href="{{ route('anime_details', $anime->id) }}">{{ $anime->title }}</a></td>
            <td>{{ $anime->rank }}</td>
            <td><img src="{{ $anime->image_url }}" alt="{{ $anime->title }}"></td>
            <td>{{ $anime->episodes }}</td>
            <td>{{ $anime->status }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
