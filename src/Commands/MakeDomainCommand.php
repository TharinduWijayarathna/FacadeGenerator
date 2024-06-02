<?php

namespace Tharindu\DDDGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class MakeDomainCommand extends Command
{
    protected $signature = 'make:domain {name}';
    protected $description = 'Generate a new domain with a service and facade';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name');

        $facadePath = base_path("domain/Facades/{$name}Facade/{$name}Facade.php");
        $servicePath = base_path("domain/Services/{$name}Service/{$name}Service.php");

        // Ensure the directories exist
        $this->makeDirectory($facadePath);
        $this->makeDirectory($servicePath);

        // Generate the files using stubs
        $this->generateFile($facadePath, 'facade.stub', $name);
        $this->generateFile($servicePath, 'service.stub', $name);

        $this->info("{$name}Facade and {$name}Service created successfully.");
    }

    protected function makeDirectory($path)
    {
        $directory = dirname($path);

        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    protected function generateFile($path, $stub, $name)
    {
        $stubPath = __DIR__ . "/../../stubs/{$stub}";

        if (!$this->files->exists($stubPath)) {
            throw new FileNotFoundException("File does not exist at path {$stubPath}.");
        }

        $stubContent = $this->files->get($stubPath);

        $content = str_replace('{{ class }}', $name, $stubContent);

        $this->files->put($path, $content);
    }
}
