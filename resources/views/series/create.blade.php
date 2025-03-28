<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post" class="mt-4 mb-4" enctype="multipart/form-data">
        @csrf

        <div class="row mb-2">
            <div class="col-8">
                <label for="name" class="form-label">Nome:</label>
                <input type="text"
                       autofocus
                       id="name"
                       name="name"
                       class="form-control mb-4"
                       value="{{ old('name') }}"
                />
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Nº Temporadas:</label>
                <input type="text"
                       id="seasonsQty"
                       name="seasonsQty"
                       class="form-control mb-4"
                       value="{{ old('seasonsQty') }}"
                />
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
                <input type="text"
                       id="episodesPerSeason"
                       name="episodesPerSeason"
                       class="form-control mb-4"
                       value="{{ old('episodesPerSeason') }}"
                />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <label for="cover" class="form-label">Capa:</label>
                <input type="file" id="cover" name="cover" class="form-control mb-4" accept="image/gif, image/jpeg, image/png" />
            </div>
        </div>

        <div class="botoes">
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="{{ route('series.index') }}" class="btn btn-dark">Voltar</a>
        </div>
    </form>
</x-layout>
