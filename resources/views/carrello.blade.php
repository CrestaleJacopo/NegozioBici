@include('layouts.header')
<main>
    <h2>Carrello</h2>

    {{-- Success message --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('carrello') && count(session('carrello')) > 0)
        @php $totale = 0; @endphp

        @foreach(session('carrello') as $articolo)
            @php $totale += $articolo['prezzo'] * $articolo['quantita']; @endphp
            <div class="articolo" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <p><strong>Nome:</strong> {{ $articolo['nome'] }}</p>
                <p><strong>Prezzo:</strong> {{ $articolo['prezzo'] }} &euro;</p>
                <p><strong>Quantità:</strong> {{ $articolo['quantita'] }}</p>
                <img src="{{ asset('images/' . $articolo['foto']) }}" alt="{{ $articolo['nome'] }}" style="width:150px;">
            </div>
        @endforeach

        <p><strong>Totale:</strong> {{ $totale }} &euro;</p>

        <p>
            <a href="{{ url('svuotaCarrello') }}">Svuota il carrello</a>
        </p>

        <p>
            <a href="{{ url('concludiOrdine') }}">Concludi ordine</a>
        </p>
    @else
        <p>Il carrello è vuoto.</p>
    @endif

    <p>Le spese di trasporto sono sempre gratis!</p>
</main>
@include('layouts.footer')