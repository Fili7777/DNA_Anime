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
            <td>
                <!-- SE L'UTENTE E' LOGGATO: -->
                @auth
                    <form action="{{ route('add_anime', $anime) }}" method="POST">
                        @csrf
                        <button type="submit">Aggiungi ai Preferiti</button>
                    </form>
                @endauth

                <!-- SE L'UTENTE E' UN OSPITE -->
                @guest
                    <div>
                        <p>Vuoi salvare questo anime?</p>
                        <a href="{{ route('login') }}">Accedi</a> o
                        <a href="{{ route('register') }}">Registrati</a>
                    </div>
                @endguest
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
