<?php

namespace Tharindu\DDDGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    protected $signature = 'make:domain {name}';
    protected $description = 'Create a new domain with a facade and service with CRUD functionality.';

    public function handle()
    {
        $name = $this->argument('name');
        $domainPath = base_path('domain');
        $facadePath = $domainPath . "/Facades/{$name}Facade.php";
        $servicePath = $domainPath . "/Services/{$name}Service.php";

        if (!File::exists($domainPath . '/Facades')) {
            File::makeDirectory($domainPath . '/Facades', 0755, true);
        }
        if (!File::exists($domainPath . '/Services')) {
            File::makeDirectory($domainPath . '/Services', 0755, true);
        }

        $stubFacadePath = __DIR__ . '/../stubs/facade.stub';
        $stubServicePath = __DIR__ . '/../stubs/service.stub';

        File::copy($stubFacadePath, $facadePath);
        File::copy($stubServicePath, $servicePath);

        $this->replacePlaceholder($facadePath, $name);
        $this->replacePlaceholder($servicePath, $name);

        $this->info("Facade and Service for {$name} created successfully.");
    }

    protected function replacePlaceholder($path, $name)
    {
        $content = File::get($path);
        $content = str_replace(['DummyName', 'DummyNamespace'], [$name, 'Domain'], $content);
        File::put($path, $content);
    }
}
