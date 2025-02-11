<?php

namespace LaravelLint\Tests;

use LaravelLint\LintServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [
            LintServiceProvider::class,
        ];
    }
}
