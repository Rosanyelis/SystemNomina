<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\RequiresTenantContext;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Bitacora;
use App\Models\Cargo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CargoController extends Controller
{
    use RequiresTenantContext;

    public function index(): View
    {
        $this->authorize('cargos.listar');

        $cargos = Cargo::orderByDesc('id')->paginate(10);

        return view('cargos.index', compact('cargos'));
    }

    public function create(): View
    {
        $this->authorize('cargos.crear');

        $this->requiresTenantContext();

        return view('cargos.create');
    }

    public function store(StoreCargoRequest $request): RedirectResponse
    {
        $this->authorize('cargos.crear');

        $this->requiresTenantContext();

        $cargo = Cargo::create([
            'empresa_id' => session('empresa_id'),
            ...$request->validated(),
        ]);

        Bitacora::registrar(
            $request->user(),
            'Creó cargo: '.$cargo->nombre,
            Cargo::class,
            $cargo->id
        );

        return redirect()->route('cargos.index')->with('success', 'Cargo creado exitosamente.');
    }

    public function edit(Cargo $cargo): View
    {
        $this->authorize('cargos.editar');

        return view('cargos.edit', compact('cargo'));
    }

    public function update(UpdateCargoRequest $request, Cargo $cargo): RedirectResponse
    {
        $this->authorize('cargos.editar');

        $cargo->update($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Actualizó cargo: '.$cargo->nombre,
            Cargo::class,
            $cargo->id
        );

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado exitosamente.');
    }

    public function destroy(Request $request, Cargo $cargo): RedirectResponse
    {
        $this->authorize('cargos.eliminar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó cargo: '.$cargo->nombre,
            Cargo::class,
            $cargo->id
        );

        $cargo->delete();

        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado exitosamente.');
    }
}
