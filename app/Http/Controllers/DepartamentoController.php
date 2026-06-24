<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\RequiresTenantContext;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Http\Requests\UpdateDepartamentoRequest;
use App\Models\Bitacora;
use App\Models\Departamento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartamentoController extends Controller
{
    use RequiresTenantContext;

    public function index(): View
    {
        $this->authorize('departamentos.listar');

        $departamentos = Departamento::orderByDesc('id')->paginate(10);

        return view('departamentos.index', compact('departamentos'));
    }

    public function create(): View
    {
        $this->authorize('departamentos.crear');

        $this->requiresTenantContext();

        return view('departamentos.create');
    }

    public function store(StoreDepartamentoRequest $request): RedirectResponse
    {
        $this->authorize('departamentos.crear');

        $this->requiresTenantContext();

        $departamento = Departamento::create([
            'empresa_id' => session('empresa_id'),
            ...$request->validated(),
        ]);

        Bitacora::registrar(
            $request->user(),
            'Creó departamento: '.$departamento->nombre,
            Departamento::class,
            $departamento->id
        );

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado exitosamente.');
    }

    public function edit(Departamento $departamento): View
    {
        $this->authorize('departamentos.editar');

        return view('departamentos.edit', compact('departamento'));
    }

    public function update(UpdateDepartamentoRequest $request, Departamento $departamento): RedirectResponse
    {
        $this->authorize('departamentos.editar');

        $departamento->update($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Actualizó departamento: '.$departamento->nombre,
            Departamento::class,
            $departamento->id
        );

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado exitosamente.');
    }

    public function destroy(Request $request, Departamento $departamento): RedirectResponse
    {
        $this->authorize('departamentos.eliminar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó departamento: '.$departamento->nombre,
            Departamento::class,
            $departamento->id
        );

        $departamento->delete();

        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado exitosamente.');
    }
}
