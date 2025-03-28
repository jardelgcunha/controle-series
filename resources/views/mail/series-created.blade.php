@component('mail::message')

# A série {{ $nomeSerie }} foi criada!

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporada(s) e {{ $episodiosPorTemporada }} episódios por temporada foi criada e disponibilizada para você.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver Série
@endcomponent

@endcomponent
