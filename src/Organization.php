<?php

declare(strict_types=1);

namespace CarloEusebi\RegistroSportESalute;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * @implements  Arrayable<string, mixed>
 *
 * @phpstan-type Icon array{icona: string, colore: string}
 */
final readonly class Organization implements Arrayable, JsonSerializable
{
    private const string BASE_URL = 'https://registro.sportesalute.eu/';

    /**
     * @param  list<string>|null  $organismi_affiliazioni_attive
     * @param  Icon|null  $richiestaAggiornamenti_icona
     * @param  Icon|null  $statoIstruttoria_icona
     */
    public function __construct(
        private ?int $id,
        private ?string $id_pad,
        private ?string $presentazione_data,
        private ?string $approvazione_data,
        private ?string $societa__codiceFiscale,
        private ?string $societa__iconaVcf,
        private ?array $organismi_affiliazioni_attive,
        private ?string $statoIstruttoria__descrizione,
        private ?string $utenza,
        private ?string $societa__natura_giuridica,
        private ?string $societa__denominazione,
        private ?string $societa__sedeLegale__regione__denominazione,
        private ?string $societa__sedeLegale__comune__denominazione,
        private ?string $affiliazione_scaduta_organismo_icona,
        private ?string $richiestaIntegrazioni_prima_data,
        private ?string $richiestaIntegrazioni_ultima_data,
        private ?string $invioIntegrazioni_prima_data,
        private ?string $invioIntegrazioni_ultima_data,
        private ?string $richiestaAggiornamenti_ultima_data,
        private ?array $richiestaAggiornamenti_icona,
        private ?string $invioAggiornamenti_ultima_data,
        private ?int $tipoIstruttoria,
        private ?array $statoIstruttoria_icona,
    ) {}

    /**
     * @param  array<string, mixed>  $organization
     */
    public static function fromArray(array $organization): self
    {
        return new self(...$organization); // @phpstan-ignore-line
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenominazione(): ?string
    {
        return $this->societa__denominazione;
    }

    public function getIdPad(): ?string
    {
        return $this->id_pad;
    }

    public function getPresentazioneData(): Carbon
    {
        return Carbon::parse($this->presentazione_data);
    }

    public function getNaturaGiuridica(): ?string
    {
        return $this->societa__natura_giuridica;
    }

    public function getDataApprovazione(): Carbon
    {
        return Carbon::parse($this->approvazione_data);
    }

    public function getCodiceFiscale(): ?string
    {
        return $this->societa__codiceFiscale;
    }

    public function getSocietaIconaVcf(): string
    {
        return $this->societa__iconaVcf !== null && $this->societa__iconaVcf !== '' && $this->societa__iconaVcf !== '0' ? self::BASE_URL.$this->societa__iconaVcf : '';
    }

    /**
     * @return list<non-falsy-string>
     */
    public function getOrganismiAffiliazioniAttive(): array
    {
        return array_map(fn (string $iconUrl): string => self::BASE_URL.$iconUrl,
            $this->organismi_affiliazioni_attive ?? []
        );
    }

    public function getStatoIstruttoriaDescrizione(): ?string
    {
        return $this->statoIstruttoria__descrizione;
    }

    public function getUtenza(): ?string
    {
        return $this->utenza;
    }

    public function getRegioneSedeLegale(): ?string
    {
        return $this->societa__sedeLegale__regione__denominazione;
    }

    public function getComuneSedeLegale(): ?string
    {
        return $this->societa__sedeLegale__comune__denominazione;
    }

    public function getAffiliazioneSCadutaOrganismoIcona(): ?string
    {
        return $this->affiliazione_scaduta_organismo_icona;
    }

    public function getRichiestaIntegrazioniPrimaData(): ?string
    {
        return $this->richiestaIntegrazioni_prima_data;
    }

    public function getRichiestaIntegrazioniUltimaData(): ?string
    {
        return $this->richiestaIntegrazioni_ultima_data;
    }

    public function getInvioIntegrazioniPrimaData(): ?string
    {
        return $this->invioIntegrazioni_prima_data;
    }

    public function getInvioIntegrazioniUltimaData(): ?string
    {
        return $this->invioIntegrazioni_ultima_data;
    }

    public function getRichiestaAggiornamentiUltimaData(): ?string
    {
        return $this->richiestaAggiornamenti_ultima_data;
    }

    /**
     * @return Icon|null
     */
    public function getRichiestaAggiornamentiIcona(): ?array
    {
        return $this->richiestaAggiornamenti_icona;
    }

    public function getInvioAggiornamentiUltimaData(): ?string
    {
        return $this->invioAggiornamenti_ultima_data;
    }

    public function getTipoIstruttoria(): ?int
    {
        return $this->tipoIstruttoria;
    }

    /**
     * @return Icon|null
     */
    public function getStatoIstruttoriaIcona(): ?array
    {
        return $this->statoIstruttoria_icona;
    }

    /**
     * Specify the data which should be serialized to JSON.
     *
     * @return array{
     *     id: int|null,
     *     denominazione: string|null,
     *     id_pad: string|null,
     *     presentazione_data: string|null,
     *     natura_giuridica: string|null,
     *     approvazione_data: string|null,
     *     codice_fiscale: string|null,
     *     societa_icona_vcf: string|null,
     *     organismi_affiliazioni_attive: list<string>,
     *     stato_istruttoria_descrizione: string|null,
     *     utenza: string|null,
     *     sede_legale_regione: string|null,
     *     sede_legale_comune: string|null,
     *     affiliazione_scaduta_organismo_icona: string|null,
     *     richiesta_integrazioni_prima_data: string|null,
     *     richiesta_integrazioni_ultima_data: string|null,
     *     invio_integrazioni_prima_data: string|null,
     *     invio_integrazioni_ultima_data: string|null,
     *     richiesta_aggiornamenti_ultima_data: string|null,
     *     richiesta_aggiornamenti_icona: Icon|null,
     *     invio_aggiornamenti_ultima_data: string|null,
     *     tipo_istruttoria: int|null,
     *     stato_istruttoria_icona: Icon|null
     * }
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the Organization as an array.
     *
     * @return array{
     *     id: int|null,
     *     denominazione: string|null,
     *     id_pad: string|null,
     *     presentazione_data: string|null,
     *     natura_giuridica: string|null,
     *     approvazione_data: string|null,
     *     codice_fiscale: string|null,
     *     societa_icona_vcf: string|null,
     *     organismi_affiliazioni_attive: list<string>,
     *     stato_istruttoria_descrizione: string|null,
     *     utenza: string|null,
     *     sede_legale_regione: string|null,
     *     sede_legale_comune: string|null,
     *     affiliazione_scaduta_organismo_icona: string|null,
     *     richiesta_integrazioni_prima_data: string|null,
     *     richiesta_integrazioni_ultima_data: string|null,
     *     invio_integrazioni_prima_data: string|null,
     *     invio_integrazioni_ultima_data: string|null,
     *     richiesta_aggiornamenti_ultima_data: string|null,
     *     richiesta_aggiornamenti_icona: Icon|null,
     *     invio_aggiornamenti_ultima_data: string|null,
     *     tipo_istruttoria: int|null,
     *     stato_istruttoria_icona: Icon|null
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'denominazione' => $this->getDenominazione(),
            'id_pad' => $this->getIdPad(),
            'presentazione_data' => $this->getPresentazioneData()->toISOString(),
            'natura_giuridica' => $this->getNaturaGiuridica(),
            'approvazione_data' => $this->getDataApprovazione()->toISOString(),
            'codice_fiscale' => $this->getCodiceFiscale(),
            'societa_icona_vcf' => $this->getSocietaIconaVcf(),
            'organismi_affiliazioni_attive' => $this->getOrganismiAffiliazioniAttive(),
            'stato_istruttoria_descrizione' => $this->getStatoIstruttoriaDescrizione(),
            'utenza' => $this->getUtenza(),
            'sede_legale_regione' => $this->getRegioneSedeLegale(),
            'sede_legale_comune' => $this->getComuneSedeLegale(),
            'affiliazione_scaduta_organismo_icona' => $this->getAffiliazioneSCadutaOrganismoIcona(),
            'richiesta_integrazioni_prima_data' => $this->getRichiestaIntegrazioniPrimaData(),
            'richiesta_integrazioni_ultima_data' => $this->getRichiestaAggiornamentiUltimaData(),
            'invio_integrazioni_prima_data' => $this->getInvioIntegrazioniPrimaData(),
            'invio_integrazioni_ultima_data' => $this->getInvioIntegrazioniUltimaData(),
            'richiesta_aggiornamenti_ultima_data' => $this->getRichiestaIntegrazioniUltimaData(),
            'richiesta_aggiornamenti_icona' => $this->getRichiestaAggiornamentiIcona(),
            'invio_aggiornamenti_ultima_data' => $this->getInvioAggiornamentiUltimaData(),
            'tipo_istruttoria' => $this->getTipoIstruttoria(),
            'stato_istruttoria_icona' => $this->getStatoIstruttoriaIcona(),
        ];
    }
}
