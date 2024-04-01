<?php

use model\object\Pilote;
use model\table\AbstractTable;
use model\table\UtilisateurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Pilote.php');

class PiloteTable extends AbstractTable
{
    public static string $ID_COLUMN = "Pilote.IdUtilisateur";

    public function __construct() { parent::__construct('Pilote'); }

    /**
     * Create a new pilote in the database
     *
     * @param Pilote $obj The pilote to create
     * @return bool True if the pilote was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    public function insert(mixed $obj): bool
    {
        $utilisateur_table = new UtilisateurTable();
        $created = $utilisateur_table->insert($obj);
        $created &= $this->insert([self::$ID_COLUMN => $obj->getId()]);
        return $created;
    }

    /**
     * Select a pilote from the database
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return array|Pilote|null The pilote selected or an empty pilote if the query fails
     */
    public function select(array $conditions): array|Pilote|null
    {
        return $this->defaultSelect(self::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, self::$ID_COLUMN), $conditions, fn($a) => Pilote::fromArray($a));
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    public function delete(mixed $id): bool
    {
        return $this->defaultDelete($id);
    }

    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }

    public static function isPilote(mixed $userId): bool
    {
        $table = new PiloteTable();
        $pilote = $table->select([self::$ID_COLUMN => $userId]);
        return $pilote !== null;
    }
}