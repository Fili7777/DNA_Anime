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

    <p>------------------</p>
    </div>
@empty
    <p>Nessun preferito trovato</p>
@endforelse
