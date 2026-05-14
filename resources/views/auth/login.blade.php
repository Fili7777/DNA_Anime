<h1>FORM LOGIN</h1>

<form action= "{{ route('login') }}" method = "POST">
    @csrf
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">ACCEDI</button>

</form>
<a href="{{ route('registerForm')}}"> <h3>Registrati ora! </h3></a>

