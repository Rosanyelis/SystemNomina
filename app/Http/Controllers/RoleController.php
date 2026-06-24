<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        $roles = Role::withCount('permissions')->orderBy('name')->get();

        return view('roles.index', compact('roles'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        $permissions = Permission::orderBy('name')->get();
        $grouped = $permissions->groupBy(fn ($p) => explode('.', $p->name)[0]);

        return view('roles.create', compact('grouped'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        if (! empty($validated['permissions'])) {
            $role->givePermissionTo($validated['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Request $request, Role $role): View
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        $permissions = Permission::orderBy('name')->get();
        $grouped = $permissions->groupBy(fn ($p) => explode('.', $p->name)[0]);
        $role->load('permissions');

        return view('roles.edit', compact('role', 'grouped'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,'.$role->id],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Request $request, Role $role): RedirectResponse
    {
        abort_unless($request->user()->hasRole('Super Admin'), 403);

        if ($role->name === 'Super Admin') {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol Super Admin.');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar un rol que tiene usuarios asignados.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
