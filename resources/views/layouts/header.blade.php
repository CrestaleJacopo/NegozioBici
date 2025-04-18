<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negozio Biciclette</title>
    <link rel="stylesheet" href="{{ asset('css/stile.css') }}">
</head>
<body>
    <header>
        <h1>Negozio Biciclette</h1>
    </header>

    <nav>
        <p id="utente">
            <a href="{{ url('login') }}">Login</a> 
            <a href="{{ url('signup') }}">Sign up</a>
            
            @if (Auth::check())
                &nbsp; Benvenuto {{ Auth::user()->name }} ({{ Auth::user()->ruolo }}) &nbsp;
                <a href="{{ url('logout') }}">Esci</a>
                <a href="{{ url('elencoMieiOrdini') }}">Miei Ordini</a>
            @else
                Benvenuto ospite
            @endif
            
        </p>

        <p>
            <a href="{{ url('') }}">Pagina Iniziale</a>
            <a href="{{ url('faq') }}">Domande Frequenti</a>
            <a href="{{ url('catalogo') }}">Catalogo</a>
            <a href="{{ url('admin/riservato') }}">Riservato</a>
            <a href="{{ url('carrello') }}">
                <img src="{{ asset('images/carrello-della-spesa.png') }}" alt="Carrello">
            </a>
            <span id="nbici">{{ count(session('carrello', [])) }}</span>
        </p>
    </nav>
