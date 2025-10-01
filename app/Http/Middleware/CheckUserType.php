<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $allowedTypes = null): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }

        $user = Auth::user();

        // se o usuário não tem tipo definido, negar acesso
        if (!$user->user_type_id) {
            abort(403, 'Acesso negado: Tipo de usuário não definido.');
        }

        if (!$user->userType) {
            abort(403, 'Acesso negado: Tipo de usuário não definido.');
        }

        $userType = $user->userType->tipo;

        // Administradores têm acesso total
        if ($userType === 'Administrador') {
            return $next($request);
        }

        // Funcionarios têm acesso restrito
        if ($userType === 'employee' || $userType === 'Funcionário') {
            $currentRoute = $request->route()->getName();

            // define as rotas permitidas para funcionários
            $allowedRoutes = [
                'projetos.index',
                'projetos.create',
                'projetos.store',
                'projetos.show',
                'projetos.edit',
                'projetos.update',
                'projetos.destroy',
                'logout',
                'index' // dashboard/home page
            ];

            // checar se a rota atual está na lista de permitidas
            if (in_array($currentRoute, $allowedRoutes)) {
                return $next($request);
            }
            // se não estiver, redirecionar para a página de projetos com mensagem de erro
            return redirect()->route('projetos.index')->with('error', 'Você só tem acesso à seção de projetos.');
        }

        // se o tipo de usuário não for reconhecido, negar acesso
        abort(403, 'Acesso negado: Tipo de usuário não autorizado.');
    }
}
