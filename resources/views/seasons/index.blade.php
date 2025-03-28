<x-layout title="Temporadas da Série {!! $series->name !!}">
    <div class="text-center mt-4">
        <img src="{{ asset('storage/' . ($series->cover ?? 'series_cover/movies.jpeg')) }}"
             style="height: 200px"
             alt="Capa da série"
             class="img-fluid"
        />
    </div>

    <ul class="list-group mt-4 mb-4">
        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', $season->id) }}">
                Temporada: {{ $season->number }}
                </a>

                <span class="badge bg-secondary">
                    {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('series.index') }}" class="btn btn-dark mb-4">Voltar</a>
</x-layout>
