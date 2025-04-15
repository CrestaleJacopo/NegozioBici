@include('layouts.header')

<main>
    <h2>Dettaglio Articolo</h2>

    <p>
        Nome: {{ $articolo->nome }} <br>
        <img src="{{ asset('images/' . $articolo->foto) }}" alt="{{ $articolo->nome }}"> <br>
        Prezzo: {{ $articolo->prezzo }} &euro;
    </p>

    {{-- Laravel form to add to cart --}}
    <form action="{{ url('carrello') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $articolo->id }}">
        <input type="hidden" name="nome" value="{{ $articolo->nome }}">
        <input type="hidden" name="prezzo" value="{{ $articolo->prezzo }}">
        <input type="hidden" name="foto" value="{{ $articolo->foto }}">
        <p>
            <input type="submit" name="submit" value="Metti nel carrello">
        </p>
    </form>
</main>

@include('layouts.footer')
