<?php

use CarloEusebi\RegistroSportESalute\Facades\RegistroSportESalute;
use CarloEusebi\RegistroSportESalute\Organization;
use Illuminate\Http\Client\HttpClientException;

it('throws exceptions works on get', function (): void {
    RegistroSportESalute::fake(shouldThrowHttpException: true);

    RegistroSportESalute::filterByCodiceFiscale('codice_fiscale')->get();
})->throws(HttpClientException::class);

it('throws exceptions works on getById', function (): void {
    RegistroSportESalute::fake(shouldThrowHttpException: true);

    RegistroSportESalute::getById(2);
})->throws(HttpClientException::class);

it('returns fake data on get', function (): void {
    RegistroSportESalute::fake();

    expect(RegistroSportESalute::get())
        ->toHaveCount(1)
        ->each->toBeInstanceOf(Organization::class);
});

test('returns correct amount of organizations', function (): void {
    RegistroSportESalute::fake(3);

    expect(RegistroSportESalute::get())->toHaveCount(3);
});

test('get by id', function (): void {
    RegistroSportESalute::fake();

    expect(RegistroSportESalute::getById(1))
        ->toBeArray();
});
