<?php
// tests/DomainGeneratorTest.php

namespace Tharindu\FacadeGenerator\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\TestCase;

class DomainGeneratorTest extends TestCase
{
    protected $app;

    /**
     * Set up the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Bootstrap Laravel application
        $this->app = $this->createApplication();
        $this->app->make(Kernel::class)->bootstrap();
    }

    /**
     * Create the Laravel application.
     *
     * @return Application
     */
    protected function createApplication(): Application
    {
        $basePath = realpath(__DIR__ . '/../..');

        // Load the Laravel application bootstrap file
        $app = require $basePath . '/vendor/autoload.php';

        $app->useEnvironmentPath($basePath);
        $app->loadEnvironmentFrom('.env.testing');

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Test the make:domain command.
     *
     * @return void
     */
    public function testMakeDomainCommand()
    {
        $serviceName = 'TestService';

        // Run the make:domain command
        Artisan::call('make:domain', ['name' => $serviceName]);

        // Check that the files were created
        $this->assertTrue(file_exists(base_path("domain/Facades/{$serviceName}Facade.php")));
        $this->assertTrue(file_exists(base_path("domain/Services/{$serviceName}Service.php")));
    }
}
