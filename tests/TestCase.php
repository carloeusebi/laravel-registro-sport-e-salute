<?php

namespace Tests;

use CarloEusebi\RegistroSportESalute\Facades\RegistroSportESalute;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @return array<string,class-string<Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [
            'RegistroSportESalute' => RegistroSportESalute::class,
            'Http' => Http::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('cache.default', 'array');
    }
}
