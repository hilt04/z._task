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

        // If user has no user_type_id, deny access
        if (!$user->user_type_id) {
            abort(403, 'Acesso negado: Tipo de usuário não definido.');
        }

        if (!$user->userType) {
            abort(403, 'Acesso negado: Tipo de usuário não definido.');
        }

        $userType = $user->userType->tipo;

        // Administrators have access to everything
        if ($userType === 'Administrador') {
            return $next($request);
        }

        // Employees only have access to project-related routes
        if ($userType === 'Funcionario') {
            $currentRoute = $request->route()->getName();

            // Define allowed routes for employees
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

            // Check if current route is allowed for employees
            if (in_array($currentRoute, $allowedRoutes)) {
                return $next($request);
            }

            // If route is not allowed, redirect to projects index
            return redirect()->route('projetos.index')->with('error', 'Você só tem acesso à seção de projetos.');
        }

        // If user type is not recognized, deny access
        abort(403, 'Acesso negado: Tipo de usuário não autorizado.');
    }
}
