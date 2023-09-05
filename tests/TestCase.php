<?php

namespace Tests;

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
}
