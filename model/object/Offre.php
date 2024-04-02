<?php

namespace model\object;

use model\table\AdresseTable;
use model\table\EntrepriseTable;
use model\table\OffreTable;
use model\table\SecteurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');

class Offre extends SerializableObject
{
    private int $id;
    private string $name;
    private string $date;
    private int $duration;
    private float $compensation;
    private int $nbPlaces;
    private int $level;
    private string $description;
    private int $id_secteur;
    private int $id_adresse;
    private int $id_company;

    public function __construct(int $id, string $name, string $date, int $duration, float $compensation, int $nbPlaces,
                                int $level, string $description, int $sector, int $address, int $company)
    {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->duration = $duration;
        $this->compensation = $compensation;
        $this->nbPlaces = $nbPlaces;
        $this->level = $level;
        $this->description = $description;
        $this->id_secteur = $sector;
        $this->id_adresse = $address;
        $this->id_company = $company;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getCompensation(): string
    {
        return $this->compensation;
    }

    public function getNbPlaces(): string
    {
        return $this->nbPlaces;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIdSecteur(): string
    {
        return $this->id_secteur;
    }

    public function getIdAdresse(): string
    {
        return $this->id_adresse;
    }

    public function getIdCompany(): string
    {
        return $this->id_company;
    }

    public function jsonSerialize(): array
    {
        $a = parent::jsonSerialize();

        unset($a[self::getColumnName(OffreTable::$SECTOR_COLUMN)]); // Remove 'IdSecteur'
        $table = new SecteurTable();
        $a['secteur'] = $table->select([SecteurTable::$ID_COLUMN => $this->getIdSecteur()]);

        unset($a[self::getColumnName(OffreTable::$ADDRESS_COLUMN)]); // Remove 'IdAdresse'
        $table = new AdresseTable();
        $a['adresse'] = $table->select([AdresseTable::$ID_COLUMN => $this->getIdAdresse()]);

        unset($a[self::getColumnName(OffreTable::$COMPANY_COLUMN)]); // Remove 'IdEntreprise'
        $table = new EntrepriseTable();
        $a['entreprise'] = $table->select([EntrepriseTable::$ID_COLUMN => $this->getIdCompany()]);

        return $a;
    }

    public function toArray(): array
    {
        return array(
            self::getColumnName(OffreTable::$ID_COLUMN) => $this->id,
            self::getColumnName(OffreTable::$NAME_COLUMN) => $this->name,
            self::getColumnName(OffreTable::$DATE_COLUMN) => $this->date,
            self::getColumnName(OffreTable::$DURATION_COLUMN) => $this->duration,
            self::getColumnName(OffreTable::$COMPENSATION_COLUMN) => $this->compensation,
            self::getColumnName(OffreTable::$NBPLACE_COLUMN) => $this->nbPlaces,
            self::getColumnName(OffreTable::$LEVEL_COLUMN) => $this->level,
            self::getColumnName(OffreTable::$DESCRIPTION_COLUMN) => $this->description,
            self::getColumnName(OffreTable::$SECTOR_COLUMN) => $this->id_secteur,
            self::getColumnName(OffreTable::$ADDRESS_COLUMN) => $this->id_adresse,
            self::getColumnName(OffreTable::$COMPANY_COLUMN) => $this->id_company
        );
    }

    public function toInsertArray(): array
    {
        return array(
            self::getColumnName(OffreTable::$NAME_COLUMN) => $this->name,
            self::getColumnName(OffreTable::$DATE_COLUMN) => $this->date,
            self::getColumnName(OffreTable::$DURATION_COLUMN) => $this->duration,
            self::getColumnName(OffreTable::$COMPENSATION_COLUMN) => $this->compensation,
            self::getColumnName(OffreTable::$NBPLACE_COLUMN) => $this->nbPlaces,
            self::getColumnName(OffreTable::$LEVEL_COLUMN) => $this->level,
            self::getColumnName(OffreTable::$DESCRIPTION_COLUMN) => $this->description,
            self::getColumnName(OffreTable::$SECTOR_COLUMN) => $this->id_secteur,
            self::getColumnName(OffreTable::$ADDRESS_COLUMN) => $this->id_adresse,
            self::getColumnName(OffreTable::$COMPANY_COLUMN) => $this->id_company
        );
    }

    public static function fromArray(array $array): Offre
    {
        return new Offre($array[self::getColumnName(OffreTable::$ID_COLUMN)],
            $array[self::getColumnName(OffreTable::$NAME_COLUMN)],
            $array[self::getColumnName(OffreTable::$DATE_COLUMN)],
            $array[self::getColumnName(OffreTable::$DURATION_COLUMN)],
            $array[self::getColumnName(OffreTable::$COMPENSATION_COLUMN)],
            $array[self::getColumnName(OffreTable::$NBPLACE_COLUMN)],
            $array[self::getColumnName(OffreTable::$LEVEL_COLUMN)],
            $array[self::getColumnName(OffreTable::$DESCRIPTION_COLUMN)],
            $array[self::getColumnName(OffreTable::$SECTOR_COLUMN)],
            $array[self::getColumnName(OffreTable::$ADDRESS_COLUMN)],
            $array[self::getColumnName(OffreTable::$COMPANY_COLUMN)]
        );
    }
}
