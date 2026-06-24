<?php

namespace App\Models;

use App\Models\Concerns\TenantScoped;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use TenantScoped;

    protected $fillable = ['empresa_id', 'nombre', 'descripcion'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
