<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Bitacora;
use App\Models\Empresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmpresaController extends Controller
{
    public function index(): View
    {
        $this->authorize('empresas.listar');

        $empresas = Empresa::withoutGlobalScopes()->orderByDesc('id')->paginate(10);

        return view('empresas.index', compact('empresas'));
    }

    public function create(): View
    {
        $this->authorize('empresas.crear');

        return view('empresas.create');
    }

    public function store(StoreEmpresaRequest $request): RedirectResponse
    {
        $this->authorize('empresas.crear');

        $empresa = Empresa::create($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Creó empresa: '.$empresa->razon_social,
            Empresa::class,
            $empresa->id,
            ['rif' => $empresa->rif]
        );

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
    }

    public function show(Empresa $empresa): View
    {
        $this->authorize('empresas.ver');

        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa): View
    {
        $this->authorize('empresas.editar');

        return view('empresas.edit', compact('empresa'));
    }

    public function update(UpdateEmpresaRequest $request, Empresa $empresa): RedirectResponse
    {
        $this->authorize('empresas.editar');

        $empresa->update($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Actualizó empresa: '.$empresa->razon_social,
            Empresa::class,
            $empresa->id
        );

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    public function toggleActivo(Request $request, Empresa $empresa): RedirectResponse
    {
        $this->authorize('empresas.desactivar');

        $empresa->update(['activo' => ! $empresa->activo]);

        $estado = $empresa->activo ? 'activada' : 'desactivada';

        Bitacora::registrar(
            $request->user(),
            "{$estado} empresa: {$empresa->razon_social}",
            Empresa::class,
            $empresa->id
        );

        return redirect()->back()->with('success', "Empresa {$estado} exitosamente.");
    }

    public function destroy(Request $request, Empresa $empresa): RedirectResponse
    {
        $this->authorize('empresas.desactivar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó empresa: '.$empresa->razon_social,
            Empresa::class,
            $empresa->id
        );

        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada exitosamente.');
    }
}
