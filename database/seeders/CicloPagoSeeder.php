<?php

namespace Database\Seeders;

use App\Models\CicloPago;
use App\Models\Empresa;
use Illuminate\Database\Seeder;

class CicloPagoSeeder extends Seeder
{
    public function run(): void
    {
        $empresas = Empresa::withoutGlobalScopes()->get();

        foreach ($empresas as $empresa) {
            CicloPago::firstOrCreate(
                ['empresa_id' => $empresa->id, 'nombre' => 'Semanal'],
                ['dias' => 7, 'activo' => true]
            );

            CicloPago::firstOrCreate(
                ['empresa_id' => $empresa->id, 'nombre' => 'Quincenal'],
                ['dias' => 15, 'activo' => true]
            );

            CicloPago::firstOrCreate(
                ['empresa_id' => $empresa->id, 'nombre' => 'Mensual'],
                ['dias' => 30, 'activo' => false]
            );
        }
    }
}
