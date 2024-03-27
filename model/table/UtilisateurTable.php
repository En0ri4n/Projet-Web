<?php
/** @noinspection DuplicatedCode */

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');

class UtilisateurTable extends AbstractTable
{
    public static string $ID_COLUMN = "Utilisateur.IdUtilisateur";
    public static string $NOM_COLUMN = "Utilisateur.Nom";
    public static string $PRENOM_COLUMN = "Utilisateur.Prenom";
    public static string $EMAIL_COLUMN = "Utilisateur.MailUtilisateur";
    public static string $PASSWORD_COLUMN = "Utilisateur.MotDePasse";
    public static string $TELEPHONE_COLUMN = "Utilisateur.TelephoneUtilisateur";

    public function __construct() { parent::__construct('Utilisateur'); }

    /**
     * Create a new utilisateur in the database
     *
     * @param Utilisateur $utilisateur The utilisateur to create
     * @return bool True if the utilisateur was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    public function insertUtilisateur(Utilisateur $utilisateur): bool
    {
        return false;
    }

    public function insert(mixed $obj): bool
    {
        $columns = array_keys($obj->fromArray());
        $values = $obj->fromArray();

        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_map((fn($column) => ":" . $column), $columns)) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($columns as $column)
            $stmt->bindParam(':' . $column, $values[$column]);
        if($stmt->execute())
            return true;
        return false;
    }

    public function delete(mixed $id): bool
    {
        $query = "DELETE FROM " . $this->getTableName() . " WHERE id = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function select(array $conditions): array|Utilisateur|null
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows) == 1)
                return Utilisateur::fromArray($rows[0]);
            else if(count($rows) > 1)
                return array_map((fn($row) => Utilisateur::fromArray($row)), $rows);
            else
                return null;
        }

        $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " = :" . $this->escape_and_lower($key)), array_keys($conditions)));

        $stmt = $this->getDatabase()->prepare($query);
        foreach($conditions as $key => $value)
        {
            $stmt->bindValue(':' . $this->escape_and_lower($key), $value);
        }
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return Utilisateur::fromArray($rows[0]);
        else if(count($rows) > 1)
            return array_map((fn($row) => Utilisateur::fromArray($row)), $rows);
        else
            return null;
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        $this->verifyArray($columns, fn($array) => count($array) != count($values), "Columns and values do not have the same length");

        $query = "UPDATE " . $this->getTableName() . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $column), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindParam(':id', $id);
        foreach($columns as $column)
            $stmt->bindValue(':' . $column, $values[$column]);
        if($stmt->execute())
            return true;
        return false;
    }

    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }

    protected function getColumnCount(): int
    {
        return 6;
    }

    /**
     * Create an instance of UtilisateurTable
     *
     * @return UtilisateurTable The instance of UtilisateurTable
     */
    public static function getUtilisateurTable(): UtilisateurTable
    {
        $instance = new UtilisateurTable();
        $instance->setTable("Utilisateur");
        return $instance;
    }
}