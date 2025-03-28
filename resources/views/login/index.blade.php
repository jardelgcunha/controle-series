<x-layout title="Login" :mensagem-sucesso="$mensagemSucesso">
    <form action="" method="post" class="mt-4">
        @csrf
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="Email do Usuário" autofocus />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" />
        </div>

        <div class="botoes mt-4">
        <button class="btn btn-primary">Entrar</button>
            <a href="{{ route('users.create') }}" class="btn btn-dark">Criar Usuário</a>
        </div>
    </form>
</x-layout>
