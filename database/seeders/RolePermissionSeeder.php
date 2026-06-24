<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    // Modelo operativo:
    // Usuarios = operadores de plataforma (sin empresa_id).
    // Solo Spatie define permisos por rol.
    // session('empresa_id') es contexto operativo, no pertenencia.
    public function run(): void
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'empresas.listar',
            'empresas.ver',
            'empresas.crear',
            'empresas.editar',
            'empresas.desactivar',

            'usuarios.listar',
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',
            'usuarios.desactivar',

            'departamentos.listar',
            'departamentos.crear',
            'departamentos.editar',
            'departamentos.eliminar',

            'cargos.listar',
            'cargos.crear',
            'cargos.editar',
            'cargos.eliminar',

            'ciclos-pago.listar',
            'ciclos-pago.crear',
            'ciclos-pago.editar',
            'ciclos-pago.eliminar',
            'ciclos-pago.desactivar',

            'parametros-legales.listar',
            'parametros-legales.crear',
            'parametros-legales.editar',
            'parametros-legales.eliminar',

            'nomina.generar',
            'nomina.ver',
            'nomina.cerrar',
            'nomina.pagar',

            'reportes.ver',
            'reportes.exportar',

            'bitacora.consultar',
            'bitacora.exportar',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        $rrhh = Role::firstOrCreate(['name' => 'RRHH', 'guard_name' => 'web']);
        $rrhh->givePermissionTo([
            'departamentos.listar',
            'departamentos.crear',
            'departamentos.editar',
            'departamentos.eliminar',
            'cargos.listar',
            'cargos.crear',
            'cargos.editar',
            'cargos.eliminar',
            'ciclos-pago.listar',
            'ciclos-pago.crear',
            'ciclos-pago.editar',
            'ciclos-pago.eliminar',
            'ciclos-pago.desactivar',
            'parametros-legales.listar',
            'parametros-legales.crear',
            'parametros-legales.editar',
            'nomina.generar',
            'nomina.ver',
            'nomina.cerrar',
            'nomina.pagar',
            'reportes.ver',
        ]);

        $contador = Role::firstOrCreate(['name' => 'Contador', 'guard_name' => 'web']);
        $contador->givePermissionTo([
            'parametros-legales.listar',
            'nomina.ver',
            'reportes.ver',
            'reportes.exportar',
            'bitacora.consultar',
            'bitacora.exportar',
        ]);

        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
