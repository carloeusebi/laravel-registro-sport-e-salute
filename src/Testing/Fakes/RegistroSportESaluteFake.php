<?php

namespace CarloEusebi\RegistroSportESalute\Testing\Fakes;

use CarloEusebi\RegistroSportESalute\Factories\OrganizationFactory;
use CarloEusebi\RegistroSportESalute\RegistroSportESalute;
use Faker\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @internal
 */
class RegistroSportESaluteFake extends RegistroSportESalute implements Fake
{
    public function __construct(
        int $count = 1,
        private readonly bool $shouldThrowHttpException = false,
    ) {
        $this->count = $count;
    }

    public function get(): Collection
    {
        if ($this->shouldThrowHttpException) {
            Http::fake([
                '*' => Http::response(body: 'Internal Server Error', status: 500),
            ]);

            return parent::get();
        }

        return collect(array_fill(0, $this->count, OrganizationFactory::create()));
    }

    public function getById(int $id): array
    {
        if ($this->shouldThrowHttpException) {
            Http::fake([
                '*' => Http::response(body: 'Internal Server Error', status: 500),
            ]);

            return parent::getById($id);
        }

        $faker = Factory::create('it_IT');

        return [
            'Codice Fiscale' => $faker->regexify('[0-9]{11}'),
            'Denominazione' => $faker->company,
            'Legale rappresentante' => strtoupper($faker->name),
            'Regione' => $faker->city,
            'Comune' => $faker->city,
            'Organismi sportivi attivi' => $faker->paragraph(),
            'Data presentazione' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d\TH:i:sP'),
            'Discipline attive' => $faker->paragraph(),
            "Nr. attività sportive organizzate nell'ultimo anno" => $faker->numberBetween(0, 20),
            "Nr. partecipazioni attività sportive nell'ultimo anno" => $faker->numberBetween(0, 1000),
            "Nr. attività didattiche organizzate nell'ultimo anno" => $faker->numberBetween(0, 10),
            'Nr. partecipazioni attività didattiche' => $faker->optional(0.7, null)->numberBetween(0, 500),
            "Nr. attività formative organizzate nell'ultimo anno" => $faker->numberBetween(0, 5),
            'Nr. tesserati attivi' => $faker->numberBetween(10, 2000),
            'Personalità Giuridica' => 'Società a Responsabilità Limitata',
        ];
    }
}
