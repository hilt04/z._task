<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Se o usuário já estiver logado, redirecione
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = DB::table('users')->where('email', $request->email)->first();

        // Se o usuário existe e a senha está correta
        if ($usuario && password_verify($request->password, $usuario->password)) {
            // Logar o usuário (cria a sessão)
            Auth::loginUsingId($usuario->id);
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Redireciona para o dashboard
        }

        // Se a validação falhar
        throw ValidationException::withMessages([
            'email' => 'E-mail ou senha inválidos.',
        ]);
    }
}
