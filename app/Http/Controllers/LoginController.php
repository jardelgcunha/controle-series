<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        $mensagemSucesso = session('mensagem.sucesso');
        return view('login.index')->withMensagemSucesso($mensagemSucesso);
    }

    public function store(LoginFormRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return to_route('series.index');
        }
        return redirect()->back()->withErrors(['email' => 'Email ou senha inválidos'])->withInput();
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login');
    }
}
