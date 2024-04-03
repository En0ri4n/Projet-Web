<?php

namespace model\object;

use model\table\AdresseTable;
use model\table\EntrepriseTable;
use model\table\LinkTable;
use model\table\SecteurTable;

class Entreprise extends SerializableObject
{
    private int $id;
    private string $nom;
    private string $site;
    private string $description;
    private string $email;
    private string $telephone;
    private string $status;

    public function __construct(int $id, string $nom, string $site, string $description, string $email, string $telephone, string $status)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->site = $site;
        $this->description = $description;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function jsonSerialize(): array
    {
        $a = parent::jsonSerialize();

        $table = LinkTable::getEntrepriseToAdresse();
        $links_entreprise_adresse = $table->select([LinkTable::getEntrepriseToAdresse()->getIdFromColumn() => $this->getId()]);
        $table = new AdresseTable();
        $adresses = \Controller::fromLinks($links_entreprise_adresse, AdresseTable::$ID_COLUMN, fn($q) => $table->selectOr($q), fn($a) => $table->select([AdresseTable::$ID_COLUMN => $a->getIdTo()]));
        $a['adresses'] = $adresses;

        $table = LinkTable::getEntrepriseToSecteur();
        $links_entreprise_secteur = $table->select([LinkTable::getEntrepriseToSecteur()->getIdFromColumn() => $this->getId()]);
        $table = new SecteurTable();
        $secteurs = \Controller::fromLinks($links_entreprise_secteur, SecteurTable::$ID_COLUMN, fn($q) => $table->selectOr($q), fn($a) => $table->select([SecteurTable::$ID_COLUMN => $a->getIdTo()]));
        $a['secteurs'] = $secteurs;

        return $a;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(EntrepriseTable::$ID_COLUMN) => $this->id,
            self::getColumnName(EntrepriseTable::$NOM_COLUMN) => $this->nom,
            self::getColumnName(EntrepriseTable::$SITE_COLUMN) => $this->site,
            self::getColumnName(EntrepriseTable::$DESCRIPTION_COLUMN) => $this->description,
            self::getColumnName(EntrepriseTable::$EMAIL_COLUMN) => $this->email,
            self::getColumnName(EntrepriseTable::$TELEPHONE_COLUMN) => $this->telephone,
            self::getColumnName(EntrepriseTable::$STATUS_COLUMN) => $this->status
        ];
    }

    public function toInsertArray()
    {
        return [
        self::getColumnName(EntrepriseTable::$NOM_COLUMN) => $this->nom,
        self::getColumnName(EntrepriseTable::$SITE_COLUMN) => $this->site,
        self::getColumnName(EntrepriseTable::$DESCRIPTION_COLUMN) => $this->description,
        self::getColumnName(EntrepriseTable::$EMAIL_COLUMN) => $this->email,
        self::getColumnName(EntrepriseTable::$TELEPHONE_COLUMN) => $this->telephone,
        self::getColumnName(EntrepriseTable::$STATUS_COLUMN) => $this->status
    ];
    }

    public static function fromArray(array $array): Entreprise
    {
        return new Entreprise(
            $array[self::getColumnName(EntrepriseTable::$ID_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$NOM_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$SITE_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$DESCRIPTION_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$EMAIL_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$TELEPHONE_COLUMN)],
            $array[self::getColumnName(EntrepriseTable::$STATUS_COLUMN)]
        );
    }
}