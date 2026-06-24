<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeleccionarEmpresaController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        abort_unless($request->user()->puedeOperarEnContextoTenant(), 403);

        $validated = $request->validate([
            'empresa_id' => ['nullable', 'exists:empresas,id'],
        ]);

        if ($validated['empresa_id']) {
            $empresa = Empresa::withoutGlobalScopes()->findOrFail($validated['empresa_id']);

            abort_unless($empresa->activo, 403, 'La empresa seleccionada está inactiva.');

            session()->put('empresa_id', $empresa->id);
        } else {
            session()->forget('empresa_id');
        }

        return redirect()->back();
    }
}
