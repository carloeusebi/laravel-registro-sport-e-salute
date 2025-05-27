<?php

declare(strict_types=1);

namespace CarloEusebi\RegistroSportESalute\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute filterByDenominazione(string $denominazione) Filter organizations by name
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute filterByCodiceFiscale(string $codiceFiscale) Filter organizations by fiscal code
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute page(int $page) Set the page number for pagination
 * @method static \CarloEusebi\RegistroSportESalute\RegistroSportESalute pageSize(int $length) Set the page size for pagination
 * @method static \Illuminate\Support\Collection<int, \CarloEusebi\RegistroSportESalute\Organization> get() Retrieve a collection of organizations
 * @method static array<string, int|string> getById(int $id) Retrieve details of an organization by ID
 *
 * @see \CarloEusebi\RegistroSportESalute\RegistroSportESalute
 */
final class RegistroSportESalute extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CarloEusebi\RegistroSportESalute\RegistroSportESalute::class;
    }
}
