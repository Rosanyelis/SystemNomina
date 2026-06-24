<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = config('app.locale', 'es');

        Carbon::setLocale($locale);
        Date::setLocale($locale);
        setlocale(LC_TIME, $locale.'_'.strtoupper($locale).'.UTF-8', $locale.'_'.strtoupper($locale));

        Gate::before(function (User $user) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
