<?php

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
        try
        {
            $query = "SELECT * FROM " . $this->getTableName() . " INNER JOIN Utilisateur ON Utilisateur.IdUtilisateur = Pilote.IdUtilisateur";

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
                return Pilote::fromArray($rows[0]);
            else if(count($rows) > 1)
                return array_map((fn($row) => Pilote::fromArray($row)), $rows);
        }
        catch(Exception $e)
        {
        }
        return null;
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
        // TODO: Implement getIdColumn() method.
        return self::$ID_COLUMN;
    }

    public static function isPilote(mixed $userId): bool
    {
        $table = new PiloteTable();
        $pilote = $table->select([self::$ID_COLUMN => $userId]);
        return $pilote !== null;
    }
}