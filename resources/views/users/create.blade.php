<x-layout title="Criar Usuário">
    <form action="" method="post" class="mt-4">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" autofocus />
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control" />
            </div>

        <div class="botoes mt-4 pb-4">
            <button class="btn btn-primary">Salvar</button>
            <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
        </div>
    </form>
</x-layout>

