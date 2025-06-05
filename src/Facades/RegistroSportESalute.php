<?php

declare(strict_types=1);

namespace CarloEusebi\RegistroSportESalute\Facades;

use CarloEusebi\RegistroSportESalute\Organization;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for the RegistroSportESalute service.
 *
 * @see \CarloEusebi\RegistroSportESalute\RegistroSportESalute
 *
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute builder()
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute filterByDenominazione(?string $denominazione)
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute filterByCodiceFiscale(?string $codiceFiscale)
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute page(int $page = 1, int $pageSize = 10)
 * @method static Collection<int, Organization> get()
 * @method static array<string, int|string> getById(int $id)
 */
class RegistroSportESalute extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CarloEusebi\RegistroSportESalute\RegistroSportESalute::class;
    }
}
