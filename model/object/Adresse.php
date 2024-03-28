<?php

namespace model\object;

use AdresseTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Adresse.php');

class Adresse implements SerializableInterface
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
            explode('.', AdresseTable::$ID_COLUMN)[1] => $this->id,
            explode('.', AdresseTable::$NUMERO_COLUMN)[1] => $this->numero,
            explode('.', AdresseTable::$RUE_COLUMN)[1] => $this->rue,
            explode('.', AdresseTable::$VILLE_COLUMN)[1] => $this->ville,
            explode('.', AdresseTable::$CODE_POSTAL_COLUMN)[1] => $this->codePostal,
            explode('.', AdresseTable::$PAYS_COLUMN)[1] => $this->pays
        ];
    }

    public static function fromArray(array $array): Adresse
    {
        return new Adresse(
            $array[explode('.', AdresseTable::$ID_COLUMN)[1]],
            $array[explode('.', AdresseTable::$NUMERO_COLUMN)[1]],
            $array[explode('.', AdresseTable::$RUE_COLUMN)[1]],
            $array[explode('.', AdresseTable::$VILLE_COLUMN)[1]],
            $array[explode('.', AdresseTable::$CODE_POSTAL_COLUMN)[1]],
            $array[explode('.', AdresseTable::$PAYS_COLUMN)[1]]);
    }
}
