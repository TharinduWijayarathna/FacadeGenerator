<?php

namespace Tharindu\FacadeGenerator;

use Illuminate\Support\ServiceProvider;

class FacadeGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Commands\MakeDomainCommand::class,
        ]);
    }

    public function boot()
    {
        // Publish stubs
        $this->publishes([
            __DIR__ . '/stubs' => resource_path('stubs/vendor/laravel-domain'),
        ]);
    }
}
