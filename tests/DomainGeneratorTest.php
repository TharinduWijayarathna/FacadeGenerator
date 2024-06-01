<?php
// tests/DomainGeneratorTest.php

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class DomainGeneratorTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Define your environment setup here.
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
