<?php

declare(strict_types=1);

namespace CarloEusebi\RegistroSportESalute;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use JsonException;

/**
 * @phpstan-type OrganizationsData array{
 *      stato: int,
 *      errory: list<mixed>,
 *      payload: array{
 *              count: int,
 *          data: list<array<string, mixed>>
 *      },
 *  }
 * @phpstan-type OrganizationDetailData array{
 *     stato: int,
 *     errori: list<mixed>,
 *     payload: array{
 *      testata: array<string, string>,
 *      immagine: array<string, string>,
 *      corpo: array{
 *          dati: list<array{ label: string, tipo: 'input'|'textarea'|'number', value: string|int }>
 *      }
 *     },
 * }
 */
final class RegistroSportESalute
{
    private const string BASE_URL = 'https://registro.sportesalute.eu/api/istruttoria';

    /** @var array<string, string|int> */
    private array $filters = [];

    private int $start = 0;

    private int $length = 10;

    private string $orderBy = 'societa__codiceFiscale';

    public function filterByDenominazione(?string $denominazione): self
    {
        if (is_string($denominazione)) {
            $this->filters['istruttoria_societa_denominazione_f'] = $denominazione;
        }

        return $this;
    }

    public function filterByCodiceFiscale(?string $codiceFiscale): self
    {
        if (is_string($codiceFiscale)) {
            $this->filters['istruttoria_societa_codiceFiscale_f'] = $codiceFiscale;
        }

        return $this;
    }

    public function page(int $page): self
    {
        $this->start = ($page - 1) * $this->length;

        return $this;
    }

    public function pageSize(int $length): self
    {
        $page = ($this->start / $length) + 1;
        $this->length = $length;

        $this->page($page);

        return $this;
    }

    /**
     * @return Collection<int, Organization>
     *
     * @throws JsonException
     */
    public function get(): Collection
    {
        $key = 'registro-sport-e-salute.list.';
        $key .= md5(json_encode([$this->filters, $this->start, $this->length, $this->orderBy], JSON_THROW_ON_ERROR));

        // @phpstan-ignore-next-line
        return Cache::remember($key, Carbon::now()->addMinutes(5), function () {
            /** @var OrganizationsData $res */
            $res = Http::get(self::BASE_URL.'/lista',
                [
                    'chiamante' => 'registroPubblico_n',
                    'start' => $this->start,
                    'length' => $this->length,
                    'order_by' => $this->orderBy,
                    ...$this->filters,
                ])
                ->throw()
                ->json();

            return collect($res['payload']['data'])
                ->map(fn (array $organization): Organization => Organization::fromArray($organization));
        });
    }

    /**
     * @return array<string, int|string>
     */
    public function getById(int $id): array
    {
        $key = "registro-sport-e-salute.detail.$id";

        // @phpstan-ignore-next-line
        return Cache::remember($key, Carbon::now()->addMinutes(5), function () use ($id) {
            /** @var OrganizationDetailData $res */
            $res = Http::get(self::BASE_URL."/$id/sidebar", [
                'chiamante' => 'registroPubblico_n',
            ])

                ->throw()
                ->json();

            return Arr::mapWithKeys($res['payload']['corpo']['dati'], fn (array $dato) => [$dato['label'] => $dato['value']]);
        });
    }
}
