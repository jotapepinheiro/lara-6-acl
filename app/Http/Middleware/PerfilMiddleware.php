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
     * @param $role
     * @param null $permissao
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permissao = null)
    {
        if ($request->user()->hasRole('super')) {
            return $next($request);
        }

        if(!$request->user()->hasRole($role)) {
            abort(404);
        }

        if($permissao !== null && !$request->user()->can($permissao)) {
            abort(404);
        }

        return $next($request);
    }
}
