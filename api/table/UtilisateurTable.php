<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class UtilisateurTable extends AbstractTable
{
    public static string $ID_COLUMN = "IdUtilisateur";
    public static string $NOM_COLUMN = "Nom";
    public static string $PRENOM_COLUMN = "Prenom";
    public static string $EMAIL_COLUMN = "MailUtilisateur";
    public static string $PASSWORD_COLUMN = "MotDePasse";
    public static string $TELEPHONE_COLUMN = "TelephoneUtilisateur";

    /**
     * Create a new utilisateur in the database
     *
     * @param Utilisateur $utilisateur The utilisateur to create
     * @return bool True if the utilisateur was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    public function insertUtilisateur(Utilisateur $utilisateur): bool
    {
        return $this->insert(
            array(
                self::$ID_COLUMN,
                self::$NOM_COLUMN,
                self::$PRENOM_COLUMN,
                self::$EMAIL_COLUMN,
                self::$PASSWORD_COLUMN,
                self::$TELEPHONE_COLUMN),
            array(
                $utilisateur->getId(),
                $utilisateur->getNom(),
                $utilisateur->getPrenom(),
                $utilisateur->getEmail(),
                $utilisateur->getPassword(),
                $utilisateur->getTelephone()
            ));
    }

    /**
     * Select a utilisateur from the database
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return Utilisateur The utilisateur selected or an empty utilisateur if the query fails
     */
    public function selectUtilisateur(array $conditions): Utilisateur
    {
        try
        {
            $stmt = $this->select($conditions);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? Utilisateur::fromArray($row) : Utilisateur::getEmpty();
        }
        catch (Exception $e)
        {
            return Utilisateur::getEmpty();
        }
    }

    #[\Override]
    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }

    #[\Override]
    protected function getColumnCount(): int
    {
        return 6;
    }

    /**
     * Create an instance of UtilisateurTable
     *
     * @param mixed $db The database to use
     * @return UtilisateurTable The instance of UtilisateurTable
     */
    public static function getUtilisateurTable(mixed $db): UtilisateurTable
    {
        $instance = new UtilisateurTable();
        $instance->setDatabase($db);
        $instance->setTable("Utilisateur");
        return $instance;
    }
}