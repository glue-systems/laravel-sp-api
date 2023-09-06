<?php

namespace Tests;

use Orchestra\Testbench\Console\Kernel as ConsoleKernel;

/**
 * Overriding the bootstrappers array of the Testbench Console Kernel
 * in order to add features to the testing suite such as loading
 * environment variables.
 */
class TestbenchConsoleKernel extends ConsoleKernel
{
    /**
     * The bootstrap classes for the application.
     *
     * @return void
     */
    protected $bootstrappers = [
        \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    ];
}
