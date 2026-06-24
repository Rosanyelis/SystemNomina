<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // Modelo operativo: usuarios = operadores de plataforma (sin empresa_id).
    // session('empresa_id') es contexto operativo para módulos tenant, no pertenencia.

    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $empresaDemo = Empresa::firstOrCreate(
            ['rif' => 'J-12345678-0'],
            [
                'razon_social' => 'Empresa Demo, C.A.',
                'telefono' => '+58 212-555-0101',
                'email' => 'demo@empresa.com',
                'direccion' => 'Av. Principal, Caracas, Venezuela',
                'activo' => true,
            ]
        );

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@systemnomina.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
                'activo' => true,
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->forceFill(['email_verified_at' => now()])->save();
        $superAdmin->assignRole('Super Admin');

        $userRrhh = User::firstOrCreate(
            ['email' => 'rrhh@systemnomina.com'],
            [
                'name' => 'María Rodríguez',
                'password' => bcrypt('password'),
                'activo' => true,
                'email_verified_at' => now(),
            ]
        );
        $userRrhh->forceFill(['email_verified_at' => now()])->save();
        $userRrhh->assignRole('RRHH');

        $userContador = User::firstOrCreate(
            ['email' => 'contador@systemnomina.com'],
            [
                'name' => 'Carlos Mendoza',
                'password' => bcrypt('password'),
                'activo' => true,
                'email_verified_at' => now(),
            ]
        );
        $userContador->forceFill(['email_verified_at' => now()])->save();
        $userContador->assignRole('Contador');

        $this->call(CicloPagoSeeder::class);
        $this->call(ParametroEmpresaSeeder::class);
    }
}
