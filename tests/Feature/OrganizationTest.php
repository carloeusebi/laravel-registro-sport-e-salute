<?php

use CarloEusebi\RegistroSportESalute\Organization;

test('organization', function (array $data): void {
    /** @var array<string, mixed> $data */
    $organization = Organization::fromArray($data);

    expect($organization->jsonSerialize())
        ->toBeArray()
        ->toHaveKeys([
            'id',
            'denominazione',
            'id_pad',
            'presentazione_data',
            'natura_giuridica',
            'approvazione_data',
            'codice_fiscale',
            'societa_icona_vcf',
            'organismi_affiliazioni_attive',
            'stato_istruttoria_descrizione',
            'utenza',
            'sede_legale_regione',
            'sede_legale_comune',
            'affiliazione_scaduta_organismo_icona',
            'richiesta_integrazioni_prima_data',
            'richiesta_integrazioni_ultima_data',
            'invio_integrazioni_prima_data',
            'invio_integrazioni_ultima_data',
            'richiesta_aggiornamenti_ultima_data',
            'richiesta_aggiornamenti_icona',
            'invio_aggiornamenti_ultima_data',
            'tipo_istruttoria',
            'stato_istruttoria_icona',
        ]
        );
})->with([
    [
        [
            'id' => 1,
            'id_pad' => '1',
            'invioAggiornamenti_ultima_data' => null,
            'richiestaAggiornamenti_ultima_data' => null,
            'richiestaAggiornamenti_icona' => [
                'icona' => 'fa-solid fa-check',
                'colore' => 'verde',
            ],
            'statoIstruttoria_icona' => [
                'icona' => 'fa-solid fa-check',
                'colore' => 'verde',
            ],
            'tipoIstruttoria' => 1,
            'presentazione_data' => '2015-05-15T02:00:00+02:00',
            'richiestaIntegrazioni_prima_data' => null,
            'richiestaIntegrazioni_ultima_data' => null,
            'invioIntegrazioni_prima_data' => null,
            'invioIntegrazioni_ultima_data' => null,
            'approvazione_data' => '2015-05-15T02:00:00+02:00',
            'societa__codiceFiscale' => '00000000001',
            'societa__iconaVcf' => 'a/random/rul',
            'societa__denominazione' => 'denominazione_1',
            'societa__sedeLegale__regione__denominazione' => 'Umbria',
            'societa__sedeLegale__comune__denominazione' => 'Terni',
            'organismi_affiliazioni_attive' => [
                'static/os/ACSI.png',
            ],
            'statoIstruttoria__descrizione' => 'Domanda accolta',
            'utenza' => '',
            'societa__natura_giuridica' => 'Associazione senza personalità giuridica',
            'affiliazione_scaduta_organismo_icona' => '',
        ],
        [
            'id' => 2,
            'id_pad' => '2',
            'invioAggiornamenti_ultima_data' => null,
            'richiestaAggiornamenti_ultima_data' => null,
            'richiestaAggiornamenti_icona' => [
                'icona' => 'fa-solid fa-check',
                'colore' => 'verde',
            ],
            'statoIstruttoria_icona' => [
                'icona' => 'fa-solid fa-check',
                'colore' => 'verde',
            ],
            'tipoIstruttoria' => 1,
            'presentazione_data' => '2011-11-25T01:00:00+01:00',
            'richiestaIntegrazioni_prima_data' => null,
            'richiestaIntegrazioni_ultima_data' => null,
            'invioIntegrazioni_prima_data' => null,
            'invioIntegrazioni_ultima_data' => null,
            'approvazione_data' => '2011-11-25T01:00:00+01:00',
            'societa__codiceFiscale' => '00000000002',
            'societa__iconaVcf' => 'a/random/url',
            'societa__denominazione' => 'denominazione_2',
            'societa__sedeLegale__regione__denominazione' => 'Puglia',
            'societa__sedeLegale__comune__denominazione' => 'Bari',
            'organismi_affiliazioni_attive' => [
                'static/os/FIGC.png',
                'static/os/ASC.png',
            ],
            'statoIstruttoria__descrizione' => 'Domanda accolta',
            'utenza' => '',
            'societa__natura_giuridica' => 'Associazione senza personalità giuridica',
            'affiliazione_scaduta_organismo_icona' => '',
        ],
    ],

]);
