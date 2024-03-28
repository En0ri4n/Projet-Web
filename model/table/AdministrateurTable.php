<?php

use model\object\Administrateur;
use model\table\AbstractTable;
use model\table\UtilisateurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Administrateur.php');

class AdministrateurTable extends AbstractTable
{
    public static string $ID_COLUMN = "Administrateur.IdUtilisateur";

    public function __construct()
    {
        parent::__construct('Administrateur');
    }

    public function insert(mixed $obj): bool
    {
        // TODO: Implement insert() method.
        return false;
    }

    public function select(array $conditions): null|array|Administrateur
    {
        return $this->defaultSelect(self::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, self::$ID_COLUMN), $conditions, 'model\object\Administrateur::fromArray');
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        // TODO: Implement update() method.
        return false;
    }

    public function delete(mixed $id): bool
    {
        // TODO: Implement delete() method.
        return false;
    }

    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }

    public static function isAdministrateur(mixed $userId): bool
    {
        $table = new AdministrateurTable();
        $administrateur = $table->select([self::$ID_COLUMN => $userId]);
        return $administrateur != null;
    }
}