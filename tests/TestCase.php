<?php

namespace Tests;

use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\Bootstrap\LoadEnvironmentVariables;
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

    protected function defineEnvironment($app)
    {
        // This is a legacy way of handling environment variable loading outside of
        // the orchestra/testbench conventions; it is not recommended for future
        // package development.
        $app->useEnvironmentPath(__DIR__ . '/..');
        app(LoadEnvironmentVariables::class)->bootstrap($app);

        tap($app['config'], function (Repository $config) {
            $laravelSpApiConfig = require __DIR__ . '/../config/sp_api.php';

            $config->set('sp_api', $laravelSpApiConfig);
        });
    }
}
