<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\RequiresTenantContext;
use App\Http\Requests\StoreParametroEmpresaRequest;
use App\Http\Requests\UpdateParametroEmpresaRequest;
use App\Models\Bitacora;
use App\Models\ParametroEmpresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParametroEmpresaController extends Controller
{
    use RequiresTenantContext;

    public function index(): View
    {
        $this->authorize('parametros-legales.listar');

        $parametros = ParametroEmpresa::orderByDesc('vigencia_desde')->paginate(10);

        return view('parametros-legales.index', compact('parametros'));
    }

    public function create(): View
    {
        $this->authorize('parametros-legales.crear');

        $this->requiresTenantContext();

        return view('parametros-legales.create');
    }

    public function store(StoreParametroEmpresaRequest $request): RedirectResponse
    {
        $this->authorize('parametros-legales.crear');

        $this->requiresTenantContext();

        $parametros = ParametroEmpresa::create([
            'empresa_id' => session('empresa_id'),
            ...$request->validated(),
        ]);

        Bitacora::registrar(
            $request->user(),
            'Creó parámetros legales vigentes desde '.$parametros->vigencia_desde->format('d/m/Y'),
            ParametroEmpresa::class,
            $parametros->id,
            ['salario_minimo' => $parametros->salario_minimo]
        );

        return redirect()->route('parametros-legales.index')->with('success', 'Parámetros legales creados exitosamente.');
    }

    public function edit(ParametroEmpresa $parametroEmpresa): View
    {
        $this->authorize('parametros-legales.editar');

        return view('parametros-legales.edit', compact('parametroEmpresa'));
    }

    public function update(UpdateParametroEmpresaRequest $request, ParametroEmpresa $parametroEmpresa): RedirectResponse
    {
        $this->authorize('parametros-legales.editar');

        $parametroEmpresa->update($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Actualizó parámetros legales vigentes desde '.$parametroEmpresa->vigencia_desde->format('d/m/Y'),
            ParametroEmpresa::class,
            $parametroEmpresa->id
        );

        return redirect()->route('parametros-legales.index')->with('success', 'Parámetros legales actualizados exitosamente.');
    }

    public function destroy(Request $request, ParametroEmpresa $parametroEmpresa): RedirectResponse
    {
        $this->authorize('parametros-legales.eliminar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó parámetros legales vigentes desde '.$parametroEmpresa->vigencia_desde->format('d/m/Y'),
            ParametroEmpresa::class,
            $parametroEmpresa->id
        );

        $parametroEmpresa->delete();

        return redirect()->route('parametros-legales.index')->with('success', 'Parámetros legales eliminados exitosamente.');
    }
}
