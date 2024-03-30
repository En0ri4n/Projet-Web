<?php

namespace model\table;

use model\object\Adresse;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Adresse.php');

class AdresseTable extends AbstractTable
{
    public static string $ID_COLUMN = 'Adresse.IdAdresse';
    public static string $NUMERO_COLUMN = 'Adresse.Numero';
    public static string $RUE_COLUMN = 'Adresse.Rue';
    public static string $VILLE_COLUMN = 'Adresse.Ville';
    public static string $CODE_POSTAL_COLUMN = 'Adresse.CodePostal';
    public static string $PAYS_COLUMN = 'Adresse.Pays';

    public function __construct()
    {
        parent::__construct('Adresse');
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): null|Adresse|array
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Adresse::fromArray');
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
        return self::$ID_COLUMN;
    }
}