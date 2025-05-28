<?php

/** @noinspection PhpUnhandledExceptionInspection */

use CarloEusebi\RegistroSportESalute\Facades\RegistroSportESalute;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

describe('successes', function (): void {

    beforeEach(function (): void {
        Http::fake([
            'https://registro.sportesalute.eu/api/istruttoria/lista*' => Http::response(['payload' => ['data' => []]]),
            'https://registro.sportesalute.eu/api/istruttoria/*/sidebar*' => Http::response(['payload' => ['corpo' => ['dati' => [['label' => 'test', 'value' => 'test']]]]]),
        ]);
    });

    it('carries authorization', function (): void {
        RegistroSportESalute::get();

        Http::assertSent(fn (Request $request): bool => $request['chiamante'] === 'registroPubblico_n');
    });

    test('filters', function (): void {
        RegistroSportESalute::builder()
            ->filterByDenominazione('denominazione')
            ->filterByCodiceFiscale('codiceFiscale')
            ->get();

        Http::assertSent(fn (Request $request): bool => $request['istruttoria_societa_denominazione_f'] === 'denominazione' &&
            $request['istruttoria_societa_codiceFiscale_f'] === 'codiceFiscale');
    });

    test('pagination', function (): void {
        RegistroSportESalute::get();
        Http::assertSent(fn (Request $request): bool => $request['start'] === 0 && $request['length'] === 10);

        RegistroSportESalute::page(2)->get();
        Http::assertSent(fn (Request $request): bool => $request['start'] === 10 && $request['length'] === 10);

        RegistroSportESalute::page(3, 20)->get();
        Http::assertSent(fn (Request $request): bool => $request['start'] === 40 && $request['length'] === 20);
    });

    test('get by id', function (): void {
        RegistroSportESalute::getById(1);

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://registro.sportesalute.eu/api/istruttoria/1/sidebar?chiamante=registroPubblico_n');
    });

    test('results are cached', function (): void {
        RegistroSportESalute::filterByDenominazione('denominazione')->get();
        RegistroSportESalute::filterByDenominazione('denominazione')->get();

        Http::assertSentCount(1);

        RegistroSportESalute::getById(2);
        RegistroSportESalute::getById(2);

        Http::assertSentCount(2);
    });
});

describe('exceptions', function (): void {
    beforeEach(function (): void {
        Http::fake([
            '*' => Http::response(null, 403),
        ]);
    });

    it('raises http exceptions on list', function (): void {
        RegistroSportESalute::get();
    })->throws(RequestException::class, 'HTTP request returned status code 403');

    it('handles', function (): void {
        RegistroSportESalute::getById(1);
    })->throws(RequestException::class, 'HTTP request returned status code 403');
});
