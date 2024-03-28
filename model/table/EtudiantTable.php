<?php
/** @noinspection DuplicatedCode */

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
        try
        {
            $query = "SELECT * FROM " . $this->getTableName() . " INNER JOIN Utilisateur ON Utilisateur.IdUtilisateur = Etudiant.IdUtilisateur";

            if(empty($conditions))
            {
                $stmt = $this->getDatabase()->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map((fn($row) => Etudiant::fromArray($row)), $rows);
            }

            $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " = :" . $this->escape_and_lower($key)), array_keys($conditions)));

            $stmt = $this->getDatabase()->prepare($query);
            foreach($conditions as $key => $value)
                $stmt->bindValue(':' . $this->escape_and_lower($key), $value);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return Etudiant::fromArray($rows[0]);
            else if(count($rows) > 1)
                return array_map((fn($row) => Etudiant::fromArray($row)), $rows);
        }
        catch(Exception $e)
        {
        }
        return null;
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
        $created = Tables::get()::$UTILISATEUR_TABLE->insert($obj);

        $created &= $this->insertWith([self::$ID_COLUMN, self::$PROMOTION_COLUMN, self::$ADRESSE_COLUMN], [$obj->getId(), $obj->getIdPromotion(), $obj->getIdAdresse()]);

        return $created;
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