<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Glue\SpApi\Laravel\SpApiServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'SpApi' => \Glue\SpApi\Laravel\Facades\SpApi::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->useEnvironmentPath(__DIR__ . '/..');

        $app->afterBootstrapping(LoadEnvironmentVariables::class, function ($app) {
            $laravelSpApiConfig = require __DIR__ . '/../config/sp_api.php';

            $app['config']->set('sp_api', $laravelSpApiConfig);
        });
    }

    /**
     * Resolve application Console Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton(Kernel::class, TestbenchConsoleKernel::class);
    }
}
