<?php

namespace App\Models;

use App\Models\Concerns\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloPago extends Model
{
    use HasFactory, TenantScoped;

    protected $table = 'ciclos_pago';

    protected $fillable = ['empresa_id', 'nombre', 'dias', 'activo'];

    protected function casts(): array
    {
        return [
            'dias' => 'integer',
            'activo' => 'boolean',
        ];
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
