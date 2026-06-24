<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (! $model->isTenantScoped()) {
            return;
        }

        $empresaId = session('empresa_id');

        if ($empresaId) {
            $builder->where($model->getTable().'.empresa_id', $empresaId);

            return;
        }

        if (Auth::check() && Auth::user()->esSuperAdmin()) {
            return;
        }

        $builder->whereRaw('1 = 0');
    }
}
