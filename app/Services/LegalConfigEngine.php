<?php

namespace App\Services;

use App\Models\Empresa;
use App\Models\ParametroEmpresa;
use Carbon\Carbon;

class LegalConfigEngine
{
    public function getParametrosVigentes(Empresa $empresa, Carbon $fecha): ?ParametroEmpresa
    {
        return ParametroEmpresa::withoutGlobalScopes()
            ->where('empresa_id', $empresa->id)
            ->where('vigencia_desde', '<=', $fecha)
            ->where(function ($q) use ($fecha) {
                $q->whereNull('vigencia_hasta')
                    ->orWhere('vigencia_hasta', '>=', $fecha);
            })
            ->orderByDesc('vigencia_desde')
            ->first();
    }

    public function tieneParametrosVigentes(Empresa $empresa, Carbon $fecha): bool
    {
        return $this->getParametrosVigentes($empresa, $fecha) !== null;
    }
}
