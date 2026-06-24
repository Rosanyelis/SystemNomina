<?php

namespace App\Models;

use App\Models\Concerns\TenantScoped;
use Database\Factories\ParametroEmpresaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametroEmpresa extends Model
{
    /** @use HasFactory<ParametroEmpresaFactory> */
    use HasFactory, TenantScoped;

    protected $table = 'parametros_empresa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'empresa_id',
        'salario_minimo',
        'porcentaje_ivss',
        'porcentaje_faov',
        'porcentaje_rpe',
        'valor_ut',
        'vigencia_desde',
        'vigencia_hasta',
    ];

    protected function casts(): array
    {
        return [
            'salario_minimo' => 'decimal:2',
            'porcentaje_ivss' => 'decimal:2',
            'porcentaje_faov' => 'decimal:2',
            'porcentaje_rpe' => 'decimal:2',
            'valor_ut' => 'decimal:2',
            'vigencia_desde' => 'date',
            'vigencia_hasta' => 'date',
        ];
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
