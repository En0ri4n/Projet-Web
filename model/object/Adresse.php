<?php

namespace model\object;

use model\table\AdresseTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Adresse.php');

class Adresse extends SerializableObject
{
    private int $id;
    private int $numero;
    private string $rue;
    private string $ville;
    private string $codePostal;
    private string $pays;

    public function __construct(int $id, int $numero, string $rue, string $ville, string $codePostal, string $pays)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->pays = $pays;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getRue(): string
    {
        return $this->rue;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getCodePostal(): string
    {
        return $this->codePostal;
    }

    public function getPays(): string
    {
        return $this->pays;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(AdresseTable::$ID_COLUMN) => $this->id,
            self::getColumnName(AdresseTable::$NUMERO_COLUMN) => $this->numero,
            self::getColumnName(AdresseTable::$RUE_COLUMN) => $this->rue,
            self::getColumnName(AdresseTable::$VILLE_COLUMN) => $this->ville,
            self::getColumnName(AdresseTable::$CODE_POSTAL_COLUMN) => $this->codePostal,
            self::getColumnName(AdresseTable::$PAYS_COLUMN) => $this->pays
        ];
    }

    public function toInsertArray(): array
    {
        return [
            self::getColumnName(AdresseTable::$NUMERO_COLUMN) => $this->numero,
            self::getColumnName(AdresseTable::$RUE_COLUMN) => $this->rue,
            self::getColumnName(AdresseTable::$VILLE_COLUMN) => $this->ville,
            self::getColumnName(AdresseTable::$CODE_POSTAL_COLUMN) => $this->codePostal,
            self::getColumnName(AdresseTable::$PAYS_COLUMN) => $this->pays
        ];
    }

    public static function fromArray(array $array): Adresse
    {
        return new Adresse(
            $array[self::getColumnName(AdresseTable::$ID_COLUMN)],
            $array[self::getColumnName(AdresseTable::$NUMERO_COLUMN)],
            $array[self::getColumnName(AdresseTable::$RUE_COLUMN)],
            $array[self::getColumnName(AdresseTable::$VILLE_COLUMN)],
            $array[self::getColumnName(AdresseTable::$CODE_POSTAL_COLUMN)],
            $array[self::getColumnName(AdresseTable::$PAYS_COLUMN)]);
    }
}
