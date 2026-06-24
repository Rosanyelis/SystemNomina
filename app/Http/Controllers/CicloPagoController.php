<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\RequiresTenantContext;
use App\Http\Requests\StoreCicloPagoRequest;
use App\Http\Requests\UpdateCicloPagoRequest;
use App\Models\Bitacora;
use App\Models\CicloPago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CicloPagoController extends Controller
{
    use RequiresTenantContext;

    public function index(): View
    {
        $this->authorize('ciclos-pago.listar');

        $ciclos = CicloPago::orderByDesc('id')->paginate(10);

        return view('ciclos-pago.index', compact('ciclos'));
    }

    public function create(): View
    {
        $this->authorize('ciclos-pago.crear');

        $this->requiresTenantContext();

        return view('ciclos-pago.create');
    }

    public function store(StoreCicloPagoRequest $request): RedirectResponse
    {
        $this->authorize('ciclos-pago.crear');

        $this->requiresTenantContext();

        $ciclo = CicloPago::create([
            'empresa_id' => session('empresa_id'),
            ...$request->validated(),
        ]);

        Bitacora::registrar(
            $request->user(),
            'Creó ciclo de pago: '.$ciclo->nombre.' ('.$ciclo->dias.' días)',
            CicloPago::class,
            $ciclo->id
        );

        return redirect()->route('ciclos-pago.index')->with('success', 'Ciclo de pago creado exitosamente.');
    }

    public function edit(CicloPago $cicloPago): View
    {
        $this->authorize('ciclos-pago.editar');

        return view('ciclos-pago.edit', compact('cicloPago'));
    }

    public function update(UpdateCicloPagoRequest $request, CicloPago $cicloPago): RedirectResponse
    {
        $this->authorize('ciclos-pago.editar');

        $cicloPago->update($request->validated());

        Bitacora::registrar(
            $request->user(),
            'Actualizó ciclo de pago: '.$cicloPago->nombre,
            CicloPago::class,
            $cicloPago->id
        );

        return redirect()->route('ciclos-pago.index')->with('success', 'Ciclo de pago actualizado exitosamente.');
    }

    public function destroy(Request $request, CicloPago $cicloPago): RedirectResponse
    {
        $this->authorize('ciclos-pago.eliminar');

        Bitacora::registrar(
            $request->user(),
            'Eliminó ciclo de pago: '.$cicloPago->nombre,
            CicloPago::class,
            $cicloPago->id
        );

        $cicloPago->delete();

        return redirect()->route('ciclos-pago.index')->with('success', 'Ciclo de pago eliminado exitosamente.');
    }
}
