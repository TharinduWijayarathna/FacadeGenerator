<?php

namespace tharindu\ddd_generator;

use harindu\ddd_generator\Commands\MakeDomainCommand;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeDomainCommand::class,
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
