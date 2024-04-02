<?php

namespace model\table;

use model\object\Secteur;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Secteur.php');

class SecteurTable extends AbstractTable
{
    public static string $ID_COLUMN = 'Secteur.IdSecteur';
    public static string $NOM_COLUMN = 'Secteur.NomSecteur';

    public function __construct() { parent::__construct('Secteur'); }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): array|Secteur|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Secteur::fromArray($a));
    }

    public function selectOr(array $conditions): array|Secteur|null
    {
        return parent::defaultSelectOr(self::no_join(), $conditions, fn($a) => Secteur::fromArray($a));
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    public function delete(mixed $id): bool
    {
        return $this->defaultDelete($id);
    }


    protected function getIdColumn(): string
    {
        return self::$NOM_COLUMN;
    }
}