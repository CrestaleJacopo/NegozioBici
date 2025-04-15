@include('layouts.header')
<main>
    <h2>Entra</h2>

    <form action="{{ url('controllaLogin') }}" method="POST">
        @csrf
        <p>
            Nome: <input type="text" name="nome" required>
        </p>
        <p>
            Password: <input type="password" name="password" required>
        </p>
        <p>
            <input type="submit" name="entra" value="Entra">
        </p>
    </form>

    <p>
        Se non ricordi la password puoi effettuare il 
        <a href="{{ url('richiestaRecuperoPassword') }}">recupero della password</a>
    </p>
</main>
@include('layouts.footer')