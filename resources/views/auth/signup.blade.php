@include('layouts.header')
<main>
    <h2>Registrazione</h2>

                @if (session('success'))
                    <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
                        {{ session('error') }}
                    </div>
                @endif

    @if ($errors->any())
        <div id="errore" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('registraUtente') }}" method="POST">
        @csrf
        <p>
            Nome <input type="text" name="nome" value="{{ old('nome') }}" required>
        </p>
        <p>
            Password <input type="password" name="password" required>
        </p>
        <p>
            Ripeti Password <input type="password" name="ripetipassword" required>
        </p>
        <p>
            Ruolo 
            <select name="ruolo">
                <option value="utente" {{ old('ruolo') == 'utente' ? 'selected' : '' }}>utente</option>
                <option value="admin" {{ old('ruolo') == 'admin' ? 'selected' : '' }}>amministratore</option>
            </select>
        </p>
        <p>
            Email <input type="email" name="email" value="{{ old('email') }}" required>
        </p>
        <p>
            <input type="submit" name="registrati" value="Registrati">
        </p>
    </form>

    <p> campo obbligatorio</p>
</main>
@include('layouts.footer')