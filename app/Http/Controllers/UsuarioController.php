<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Bitacora;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $this->authorize('usuarios.listar');

        $usuarios = User::with('roles')->orderByDesc('id')->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        $this->authorize('usuarios.crear');

        $roles = Role::all();

        return view('usuarios.create', compact('roles'));
    }

    public function store(StoreUsuarioRequest $request): RedirectResponse
    {
        $this->authorize('usuarios.crear');

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'activo' => $validated['activo'] ?? true,
        ]);

        $user->assignRole($validated['role']);

        Bitacora::registrar(
            $request->user(),
            'Creó usuario: '.$user->email,
            User::class,
            $user->id,
            ['role' => $validated['role']]
        );

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $usuario): View
    {
        $this->authorize('usuarios.editar');

        $roles = Role::all();
        $usuario->load('roles');

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(UpdateUsuarioRequest $request, User $usuario): RedirectResponse
    {
        $this->authorize('usuarios.editar');

        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'activo' => $validated['activo'] ?? true,
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $usuario->update($data);
        $usuario->syncRoles([$validated['role']]);

        Bitacora::registrar(
            $request->user(),
            'Actualizó usuario: '.$usuario->email,
            User::class,
            $usuario->id,
            ['role' => $validated['role']]
        );

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function toggleActivo(Request $request, User $usuario): RedirectResponse
    {
        $this->authorize('usuarios.desactivar');

        $usuario->update(['activo' => ! $usuario->activo]);

        $estado = $usuario->activo ? 'activado' : 'desactivado';

        Bitacora::registrar(
            $request->user(),
            "{$estado} usuario: {$usuario->email}",
            User::class,
            $usuario->id
        );

        return redirect()->back()->with('success', "Usuario {$estado} exitosamente.");
    }

    public function destroy(Request $request, User $usuario): RedirectResponse
    {
        $this->authorize('usuarios.eliminar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó usuario: '.$usuario->email,
            User::class,
            $usuario->id
        );

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
