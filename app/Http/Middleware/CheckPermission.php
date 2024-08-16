<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected $primaryKey = 'permission_id'; // Definir la clave primaria

    public function handle(Request $request, Closure $next, $permission)
    {
        if (!$request->user() || !$request->user()->hasPermission($permission)) {
            return redirect('/no-access'); // Redirige a una página de acceso denegado
        }

        return $next($request);
    }
    
}
