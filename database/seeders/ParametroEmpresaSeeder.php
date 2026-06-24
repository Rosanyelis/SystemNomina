<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\ParametroEmpresa;
use Illuminate\Database\Seeder;

class ParametroEmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $empresas = Empresa::withoutGlobalScopes()->get();

        foreach ($empresas as $empresa) {
            ParametroEmpresa::firstOrCreate(
                ['empresa_id' => $empresa->id, 'vigencia_desde' => '2026-01-01'],
                [
                    'salario_minimo' => 130.00,
                    'porcentaje_ivss' => 4.00,
                    'porcentaje_faov' => 1.00,
                    'porcentaje_rpe' => 0.50,
                    'valor_ut' => 43.00,
                    'vigencia_hasta' => null,
                ]
            );
        }
    }
}
