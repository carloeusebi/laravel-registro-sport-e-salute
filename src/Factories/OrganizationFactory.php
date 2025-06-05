<?php

namespace CarloEusebi\RegistroSportESalute\Factories;

use CarloEusebi\RegistroSportESalute\Organization;
use Faker\Factory;

class OrganizationFactory
{
    public static function create(): Organization
    {
        $faker = Factory::create('it_IT');

        return Organization::fromArray([
            'id' => $faker->numberBetween(100000, 999999),
            'id_pad' => str_pad((string) $faker->numberBetween(100000, 999999), 8, '0', STR_PAD_LEFT),
            'presentazione_data' => $faker->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d\TH:i:sP'),
            'approvazione_data' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d\TH:i:sP'),
            'societa__codiceFiscale' => $faker->regexify('[0-9]{11}'),
            'societa__iconaVcf' => 'static/icons/age_'.$faker->numberBetween(1, 10).'.png',
            'organismi_affiliazioni_attive' => [
                'static/os/asi.png',
            ],
            'statoIstruttoria__descrizione' => $faker->randomElement(['Domanda accolta', 'In attesa', 'Domanda respinta']),
            'utenza' => $faker->optional(0.7, '')->userName,
            'societa__natura_giuridica' => $faker->randomElement(['Società a Responsabilità Limitata', 'Associazione Sportiva Dilettantistica', 'Società Sportiva Dilettantistica']),
            'societa__denominazione' => $faker->company,
            'societa__sedeLegale__regione__denominazione' => $faker->citySuffix,
            'societa__sedeLegale__comune__denominazione' => $faker->city,
            'affiliazione_scaduta_organismo_icona' => $faker->optional(0.3, '')->imageUrl(50, 50),
            'richiestaIntegrazioni_prima_data' => $faker->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d\TH:i:sP'),
            'richiestaIntegrazioni_ultima_data' => $faker->dateTimeBetween('-6 months', '-3 months')->format('Y-m-d\TH:i:sP'),
            'invioIntegrazioni_prima_data' => $faker->dateTimeBetween('-3 months', '-2 months')->format('Y-m-d\TH:i:sP'),
            'invioIntegrazioni_ultima_data' => $faker->dateTimeBetween('-2 months', '-1 month')->format('Y-m-d\TH:i:sP'),
            'richiestaAggiornamenti_ultima_data' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d\TH:i:sP'),
            'richiestaAggiornamenti_icona' => [
                'icona' => $faker->randomElement(['fa-solid fa-check', 'fa-solid fa-times', 'fa-solid fa-exclamation']),
                'colore' => $faker->randomElement(['verde', 'rosso', 'giallo']),
            ],
            'invioAggiornamenti_ultima_data' => $faker->dateTimeBetween('-1 month')->format('Y-m-d\TH:i:sP'),
            'tipoIstruttoria' => $faker->numberBetween(1, 3),
            'statoIstruttoria_icona' => [
                'icona' => $faker->randomElement(['fa-solid fa-check', 'fa-solid fa-times', 'fa-solid fa-exclamation']),
                'colore' => $faker->randomElement(['verde', 'rosso', 'giallo']),
            ],
        ]);
    }
}
