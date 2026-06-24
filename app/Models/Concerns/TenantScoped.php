<?php

namespace App\Models\Concerns;

use App\Models\Scopes\TenantScope;

trait TenantScoped
{
    public static function bootTenantScoped(): void
    {
        static::addGlobalScope(new TenantScope);
    }

    public function isTenantScoped(): bool
    {
        return true;
    }

    public function initializeTenantScoped(): void
    {
        if (! $this->empresa_id && session('empresa_id')) {
            $this->empresa_id = session('empresa_id');
        }
    }
}
