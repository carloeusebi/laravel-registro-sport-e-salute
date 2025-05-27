<?php

declare(strict_types=1);

namespace CarloEusebi\RegistroSportESalute\Facades;

use Illuminate\Support\Facades\Facade;

final class RegistroSportESalute extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CarloEusebi\RegistroSportESalute\RegistroSportESalute::class;
    }
}
