<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Following setup instructions from orchestral/testbench docs:
 * https://github.com/orchestral/testbench/tree/476ef1adabbddbf5ba72705590ee67737a86decc
 */
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
        // There was no documentation for v3 that I could find on how to
        // implement hydrating of a config file that relies on env values
        // (standard Laravel stuff). The below implementation follows ideas from
        // https://github.com/orchestral/testbench/issues/211#issuecomment-360885812
        // as well as what I could figure out from the testbench source code.
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
