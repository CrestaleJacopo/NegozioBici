@include('layouts.header')
<main>
    <h2>Domande Frequenti</h2>

    <p id="download">
        Scaricati le 
        <a href="{{ url('download/istruzioni.pdf') }}">istruzioni</a>
        &nbsp;
            <a href="{{ url('download/istruzioni.pdf') }}">
           <img src="{{ asset('images/download.png') }}" alt="Download">
        </a>
    </p>

    @foreach(range(1, 4) as $i)
        <article>
            <h4>Come si fa un ordine?</h4>
            <p>
                Vai nel catalogo e vai a ciciccicicciic
                cicicicicic cicicici cicicicicicic
                ciaosfiao faioai fafaf.
            </p>
        </article>
    @endforeach
</main>
@include('layouts.footer')