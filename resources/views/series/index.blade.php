<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <ul class="list-group mt-4 {{ auth()->check() ? 'mb-4' : 'mb-5' }}">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <img src="{{ asset('storage/' . ($serie->cover ?? '/series_cover/movies.jpeg')) }}" alt="Tumbnail da série" width="80" class="img-thumbnail me-3">

                    @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                        {{ $serie->name }}
                    @auth</a> @endauth
                </div>


                @auth
                <span class="d-flex">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        E
                    </a>
                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
                </span>
                @endauth
            </li>
        @endforeach
    </ul>

    @auth
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-4">Adicionar Série</a>
    @endauth
</x-layout>
