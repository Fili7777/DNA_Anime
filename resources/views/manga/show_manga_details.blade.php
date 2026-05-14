<h1>Recensioni: </h1>
@forelse($reviews as $review )
    <p> {{ $review }} </p>
@empty
    <p>Nessuna review trovata</p>
@endforelse
