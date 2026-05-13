<h1>Benvenuto {{auth()->user()->name}}</h1>
<h3>Cosa vuoi fare:</h3>
<ul>

    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; padding:0;">
                Logout
            </button>
        </form>
    </li>


    <li><a href="{{ route('anime') }}"> Mostra Lista Anime </a> </li>
    <li><a href="{{ route('manga') }}"> Mostra Lista manga </a> </li>
</ul>
