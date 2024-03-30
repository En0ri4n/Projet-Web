<?php

namespace model\object;

use model\table\OffreTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');
class Offre implements SerializableInterface
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

    public function toArray(): array
    {
        return array(explode('.', OffreTable::$ID_COLUMN)[1] => $this->id,
            explode('.', OffreTable::$NAME_COLUMN)[1] => $this->name,
            explode('.', OffreTable::$DATE_COLUMN)[1] => $this->date,
            explode('.', OffreTable::$DURATION_COLUMN)[1] => $this->duration,
            explode('.', OffreTable::$COMPENSATION_COLUMN)[1] => $this->compensation,
            explode('.', OffreTable::$NBPLACE_COLUMN)[1] => $this->nbPlaces,
            explode('.', OffreTable::$LEVEL_COLUMN)[1] => $this->level,
            explode('.', OffreTable::$DESCRIPTION_COLUMN)[1] => $this->description,
            explode('.', OffreTable::$SECTOR_COLUMN)[1] => $this->id_secteur,
            explode('.', OffreTable::$ADDRESS_COLUMN)[1] => $this->id_adresse,
            explode('.', OffreTable::$COMPANY_COLUMN)[1] => $this->id_company);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public static function fromArray(array $array): Offre
    {
        return new Offre($array[explode('.', OffreTable::$ID_COLUMN)[1]],
            $array[explode('.', OffreTable::$NAME_COLUMN)[1]],
            $array[explode('.', OffreTable::$DATE_COLUMN)[1]],
            $array[explode('.', OffreTable::$DURATION_COLUMN)[1]],
            $array[explode('.', OffreTable::$COMPENSATION_COLUMN)[1]],
            $array[explode('.', OffreTable::$NBPLACE_COLUMN)[1]],
            $array[explode('.', OffreTable::$LEVEL_COLUMN)[1]],
            $array[explode('.', OffreTable::$DESCRIPTION_COLUMN)[1]],
            $array[explode('.', OffreTable::$SECTOR_COLUMN)[1]],
            $array[explode('.', OffreTable::$ADDRESS_COLUMN)[1]],
            $array[explode('.', OffreTable::$COMPANY_COLUMN)[1]],);
    }
}
