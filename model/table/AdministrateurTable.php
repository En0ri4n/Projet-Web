<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Administrateur.php');

class AdministrateurTable extends AbstractTable
{
    public static string $ID_COLUMN = "Administrateur.IdUtilisateur";
    public static string $NOM_COLUMN = "Utilisateur.Nom";
    public static string $PRENOM_COLUMN = "Utilisateur.Prenom";
    public static string $EMAIL_COLUMN = "Utilisateur.MailUtilisateur";
    public static string $PASSWORD_COLUMN = "Utilisateur.MotDePasse";
    public static string $TELEPHONE_COLUMN = "Utilisateur.TelephoneUtilisateur";

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
        try
        {
            $query = "SELECT * FROM " . $this->getTableName() . " INNER JOIN Utilisateur ON Utilisateur.IdUtilisateur = Administrateur.IdUtilisateur";

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
                return Administrateur::fromArray($rows[0]);
            else if(count($rows) > 1)
                return array_map((fn($row) => Administrateur::fromArray($row)), $rows);
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
        return self::$ID_COLUMN;
    }

    public static function isAdministrateur(mixed $userId): bool
    {
        $table = new AdministrateurTable();
        $administrateur = $table->select([self::$ID_COLUMN => $userId]);
        return $administrateur != null;
    }
}