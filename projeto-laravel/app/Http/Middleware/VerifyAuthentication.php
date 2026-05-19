<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado e o tipo do usuário na sessão é 'admin'
        if (!session()->has('usuario_id') || session('usuario_tipo') !== 'admin') {
            // return redirect('/');

            // Se não for admin, redireciona para a home com uma mensagem de erro (opcional):
            return redirect()->route('home')->with('erro', 'Acesso restrito apenas para administradores.');        }

        return $next($request);
    }
}
