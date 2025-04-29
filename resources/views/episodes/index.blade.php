<x-layout title="Episódios da Série {{ $series->name }}" :mensagem-sucesso="$mensagemSucesso">
    <form action="" method="post">
        @csrf
        <ul class="list-group mt-4 mb-4">
            @foreach($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <label for="checkbox{{ $episode->number }}" id="checkbox">
                        Episódio: {{ $episode->number }}
                    </label>

                    <input
                        type="checkbox"
                        name="episodes[]"
                        class="checkbox-item"
                        id="checkbox{{ $episode->number }}"
                        value="{{ $episode->id }}"
                        @if($episode->watched) checked @endif
                    />
                </li>
            @endforeach
        </ul>


        <div class="botoes pb-4">
            <button class="btn btn-primary">Salvar</button>
            <button type="button" id="checkAllButton" class="btn btn-success">Assistir Todos</button>
            <a href="{{ route('seasons.index', $series->id) }}" class="btn btn-dark">Voltar</a>
        </div>
    </form>

    <script>
        document.getElementById('checkAllButton').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.checkbox-item');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        });
    </script>
</x-layout>
