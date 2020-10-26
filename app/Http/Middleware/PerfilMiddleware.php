<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PerfilMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $perfil
     * @param null $permissao
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $perfil, $permissao = null)
    {
        if ($request->user()->hasPerfil('super')) {
            return $next($request);
        }

        if(!$request->user()->hasPerfil($perfil)) {
            abort(404);
        }

        if($permissao !== null && !$request->user()->can($permissao)) {
            abort(404);
        }

        return $next($request);
    }
}
