<h1>Lista Preferiti:</h1>
@forelse( $favourites as $favourite )
    <div>
        <p>Titolo: {{$favourite->favourable->title}}</p>

        @php
        //togliamo APP\MODEL\ -> cosi che resta solo anime o manga
        $var = $favourite->favourable_type;
        $tipi = explode("\\", $var );
        $tipo = $tipi[2];
        @endphp

        <p>Tipo: {{ $tipo }}  </p>


        @if($tipo == 'Anime')
            <p>Episodi: {{ $favourite->favourable->episodes}}</p>

        @else
            <p>Volumi {{ $favourite->favourable->volumes}}</p>
        @endif

        <!-- Pulsante per rimuovere dai preferiti -->
        <form action="{{ route('delete_favourite', $favourite ) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Rimuovi dai Preferiti</button>
        </form>

    <p>------------------</p>
    </div>
@empty
    <p>Nessun preferito trovato</p>
@endforelse
