<?php

namespace model\object;

use model\table\SecteurTable;

class Secteur extends SerializableObject
{
    private int $id;
    private string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(SecteurTable::$ID_COLUMN) => $this->getId(),
            self::getColumnName(SecteurTable::$NOM_COLUMN) => $this->getNom()
        ];
    }

    public static function fromArray(array $array): Secteur
    {
        return new Secteur($array[self::getColumnName(SecteurTable::$ID_COLUMN)], $array[self::getColumnName(SecteurTable::$NOM_COLUMN)]);
    }
}