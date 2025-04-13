<form action="{{ $action }}" method="post" class="mt-4 mb-3" enctype="multipart/form-data">
    @csrf
    @if($update)
        @method('PUT')
    @endif
    <input type="hidden" name="update_seasons_episodes" value="false">
    <div class="row">
        <div class="col-5">
            <label for="name" class="form-label">Nome:</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control mb-4"
                   @isset($name)value="{{ $name }}"@endisset
            />
        </div>

        <div class="col-7">
            <label for="cover" class="form-label">Capa:</label>
            <input type="file" id="cover" name="cover" class="form-control mb-4" accept="image/gif, image/jpeg, image/png" />
        </div>
    </div>
    <div class="botoes">
        <button type="submit" class="btn btn-primary">Adicionar</button>
        <a href="{{ route('series.index') }}" class="btn btn-dark">Voltar</a>
    </div>
</form>
