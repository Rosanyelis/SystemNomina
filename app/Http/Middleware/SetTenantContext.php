<?php

namespace App\Http\Middleware;

use App\Models\Empresa;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTenantContext
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($empresaId = session('empresa_id')) {
            $empresa = Empresa::withoutGlobalScopes()->find($empresaId);

            if (! $empresa || ! $empresa->activo) {
                session()->forget('empresa_id');
            }
        }

        return $next($request);
    }
}
