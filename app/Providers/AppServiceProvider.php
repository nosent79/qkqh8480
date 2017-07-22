<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('collect', function($v) {
            return "<?php {$v} = collect({$v}); ?>";
        });
    }

    public function register()
    {
        if ($this->app->environment() !== 'production') {
            \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
                \Log::info(print_r([
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time,
                ], true));
            });
        }
    }
}
