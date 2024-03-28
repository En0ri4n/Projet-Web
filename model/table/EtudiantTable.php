<?php
/** @noinspection DuplicatedCode */

use model\object\Etudiant;
use model\table\AbstractTable;
use model\table\UtilisateurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Etudiant.php');

class EtudiantTable extends AbstractTable
{
    public static string $ID_COLUMN = "Etudiant.IdUtilisateur";
    public static string $PROMOTION_COLUMN = "Etudiant.IdPromotion";
    public static string $ADRESSE_COLUMN = "Etudiant.IdAdresse";

    public function __construct() { parent::__construct('Etudiant'); }

    /**
     * Select an etudiant from the database
     *
     * @param mixed $conditions Associative array of column keys and values to select
     * @return array|Etudiant|null The etudiant selected, a list of etudiants if multiple were found, or an empty etudiant if none were found
     */
    public function select(array $conditions): array|Etudiant|null
    {
        return $this->defaultSelect(self::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, self::$ID_COLUMN), $conditions, 'model\object\Etudiant::fromArray');
    }

    /**
     * Create a new etudiant in the database
     *
     * @return bool True if the etudiant was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    /* @throws Exception If the parameter is not an Etudiant
     * @var $obj Etudiant The etudiant to insert
     */
    public function insert(mixed $obj): bool
    {
        // TODO: Implement insert() method.
        return false;
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

    public static function isEtudiant(mixed $userId): bool
    {
        $table = new EtudiantTable();
        $etudiant = $table->select([self::$ID_COLUMN => $userId]);
        return $etudiant !== null;
    }
}