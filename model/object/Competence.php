<?php

namespace model\object;

use model\table\CompetenceTable;

class Competence extends SerializableObject
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

    public function toInsertArray(): array
    {
        return [
            self::getColumnName(CompetenceTable::$NOM_COLUMN) => $this->nom
        ];
    }

    public function toArray(): array
    {
       return [
           self::getColumnName(CompetenceTable::$ID_COLUMN) => $this->id,
           self::getColumnName(CompetenceTable::$NOM_COLUMN) => $this->nom
       ];
    }

    public static function fromArray(array $array): Competence
    {
        return new Competence($array[self::getColumnName(CompetenceTable::$ID_COLUMN)], $array[self::getColumnName(CompetenceTable::$NOM_COLUMN)]);
    }
}