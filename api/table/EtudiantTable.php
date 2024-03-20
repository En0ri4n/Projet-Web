<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class EtudiantTable extends UtilisateurTable
{
    public static string $PROMOTION_COLUMN = "IdPromotion";
    public static string $ADRESSE_COLUMN = "IdAdresse";

    /**
     * Select an etudiant from the database
     *
     * @param mixed $conditions Associative array of column keys and values to select
     * @return Etudiant The etudiant selected or an empty etudiant if the query fails
     */
    public function selectEtudiant(mixed $conditions): Etudiant
    {
        try
        {
            $stmt = $this->select($conditions);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? Etudiant::fromArray($row) : Etudiant::getEmpty();
        }
        catch (Exception $e)
        {
            return Etudiant::getEmpty();
        }
    }

    /**
     * Create a new etudiant in the database
     *
     * @param Etudiant $etudiant The etudiant to create
     * @return bool True if the etudiant was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    public function insertEtudiant(Etudiant $etudiant): bool
    {
        $created = self::getUtilisateurTable($this->getDatabase())->insertUtilisateur($etudiant);

        $created &= $this->insert([self::$ID_COLUMN, self::$PROMOTION_COLUMN, self::$ADRESSE_COLUMN], [$etudiant->getId(), $etudiant->getIdPromotion(), $etudiant->getIdAdresse()]);

        return $created;
    }

    public static function getEtudiantTable($db): EtudiantTable
    {
        $instance = new EtudiantTable();
        $instance->setDatabase($db);
        $instance->setTable("Etudiant");
        return $instance;
    }
}