<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettaglio Anime - {{ $anime->title }}</title>
</head>
<body>
<a href="{{ route('anime') }}">Torna alla lista Anime</a>

<!-- 1. DETTAGLI DELL'ANIME -->
<h1>{{ $anime->title }}</h1>
<img src="{{ $anime->image_url }}" alt="{{ $anime->title }}">
<p><strong>Rank:</strong> {{ $anime->rank }}</p>
<p><strong>Stato:</strong> {{ $anime->status }}</p>

@auth
    <form action="{{ route('add_anime', $anime) }}" method="POST">
        @csrf
        <button type="submit">Aggiungi ai Preferiti</button>
    </form>
@endauth

<hr>

<h2>Recensioni Recenti:</h2>
@if(count($reviews) > 0)
    <ul>
        @foreach($reviews as $reviewTesto)
            <li>
                {{ $reviewTesto }}

            </li>
            <br>
        @endforeach
    </ul>
@else
    <p>Nessuna recensione disponibile al momento.</p>
@endif

<hr>

@forelse($anime->listEpisodes as $episode)
    <p>Titolo: {{$episode->title}} </p>
@empty
    nessun episodio trovato
@endforelse

</body>
</html>
