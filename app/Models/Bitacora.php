<?php

namespace App\Models;

use Database\Factories\BitacoraFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    /** @use HasFactory<BitacoraFactory> */
    use HasFactory;

    protected $table = 'bitacora';

    protected $fillable = [
        'usuario_id',
        'empresa_id',
        'accion',
        'entidad_type',
        'entidad_id',
        'detalles',
    ];

    protected function casts(): array
    {
        return [
            'detalles' => 'array',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public static function registrar(User $usuario, string $accion, ?string $entidadType = null, ?int $entidadId = null, ?array $detalles = null): self
    {
        return static::create([
            'usuario_id' => $usuario->id,
            'empresa_id' => session('empresa_id'),
            'accion' => $accion,
            'entidad_type' => $entidadType,
            'entidad_id' => $entidadId,
            'detalles' => $detalles,
        ]);
    }
}
