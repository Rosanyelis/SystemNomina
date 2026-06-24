<?php

namespace App\Http\Controllers\Concerns;

trait RequiresTenantContext
{
    protected function requiresTenantContext(): void
    {
        abort_unless(session('empresa_id'), 403, 'Seleccione una empresa en el encabezado antes de continuar.');
    }
}
