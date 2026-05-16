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
            <td> <a href="{{ route('manga_details', $manga->id) }}"> {{ $manga->title }} </a></td>
            <td>{{ $manga->rank }}</td>
            <td><img src="{{ $manga->image_url }}" alt="{{ $manga->title }}"></td>
            <td>{{ $manga->volumes }}</td>
            <td>{{ $manga->status }}</td>
        </tr>

        <td>
            <!-- SE L'UTENTE E' LOGGATO: -->
            @auth
                <form action="{{ route('add_manga', $manga) }}" method="POST">
                    @csrf
                    <button type="submit">Aggiungi ai Preferiti</button>
                </form>
            @endauth

            <!-- SE L'UTENTE E' UN OSPITE -->
            @guest
                <div>
                    <p>Vuoi salvare questo manga?</p>
                    <a href="{{ route('login') }}">Accedi</a> o
                    <a href="{{ route('register') }}">Registrati</a>
                </div>
            @endguest
        </td>
    @endforeach
</table>


<div >
    {{ $mangaList->links() }}
</div>

</body>
</html>
