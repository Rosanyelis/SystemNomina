<?php

namespace App\Models;

use App\Models\Concerns\TenantScoped;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use TenantScoped;

    protected $fillable = ['empresa_id', 'nombre'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
