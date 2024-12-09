<?php

namespace Cone\Package\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;

    public function createApplication(): Application
    {
        $app = require __DIR__.'/app.php';

        $app->booting(static function () use ($app): void {
            $app->afterResolving('migrator', function ($migrator) {
                $migrator->path(__DIR__.'/migrations');
            });
        });

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();

        //
    }
}
