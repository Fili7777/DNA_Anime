<h1>FORM REGISTRAZIONE</h1>

<form action= "{{ route('register') }}" method = "POST">
    @csrf
    <label>Nome:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrati</button>
</form>
<a href="{{ route('loginForm')}}"> <h3>Accedi ora! </h3></a>
