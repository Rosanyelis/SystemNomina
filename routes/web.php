<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CicloPagoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ParametroEmpresaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeleccionarEmpresaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::post('/seleccionar-empresa', SeleccionarEmpresaController::class)
    ->middleware(['auth'])
    ->name('seleccionar-empresa');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('empresas', EmpresaController::class);
    Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'usuario']);
    Route::resource('departamentos', DepartamentoController::class);
    Route::resource('cargos', CargoController::class);
    Route::resource('ciclos-pago', CicloPagoController::class)->parameters(['ciclos-pago' => 'cicloPago']);
    Route::resource('parametros-legales', ParametroEmpresaController::class)->parameters(['parametros-legales' => 'parametroEmpresa']);

    Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::resource('roles', RoleController::class)->parameters(['roles' => 'role']);

    Route::get('/reports/payroll-summary', [ReportController::class, 'payrollSummary'])->name('reports.payroll-summary');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
