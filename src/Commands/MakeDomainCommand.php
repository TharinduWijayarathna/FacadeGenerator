<?php

namespace Tharindu\DDDGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    protected $signature = 'make:domain {name}';
    protected $description = 'Create a new domain with a facade and service.';

    public function handle()
    {
        $name = $this->argument('name');
        $facadePath = app_path("Domain/Facades/{$name}Facade.php");
        $servicePath = app_path("Domain/Services/{$name}Service.php");

        if (!File::exists(app_path('Domain/Facades'))) {
            File::makeDirectory(app_path('Domain/Facades'), 0755, true);
        }
        if (!File::exists(app_path('Domain/Services'))) {
            File::makeDirectory(app_path('Domain/Services'), 0755, true);
        }

        File::copy(resource_path('stubs/vendor/laravel-domain/facade.stub'), $facadePath);
        File::copy(resource_path('stubs/vendor/laravel-domain/service.stub'), $servicePath);

        $this->replacePlaceholder($facadePath, $name);
        $this->replacePlaceholder($servicePath, $name);

        $this->info("Facade and Service for {$name} created successfully.");
    }

    protected function replacePlaceholder($path, $name)
    {
        $content = File::get($path);
        $content = str_replace(['DummyName', 'DummyNamespace'], [$name, 'App\\Domain'], $content);
        File::put($path, $content);
    }
}
