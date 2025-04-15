@include('layouts.header')
<main>
    <h2>Catalogo</h2>

    <table>
        <tr><th>ID</th><th>Nome</th><th>Prezzo</th></tr>
        @if(isset($articoli) && count($articoli) > 0)
            @foreach($articoli as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td><a href="{{ url('dettaglio/'.$a->id) }}">{{ $a->nome }}</a></td>
                    <td><a>{{ $a->prezzo }}</a></td>

                </tr>
            @endforeach
        @else
            <tr><td colspan="2">Nessun articolo disponibile</td></tr>
        @endif
    </table>
</main>
@include('layouts.footer')