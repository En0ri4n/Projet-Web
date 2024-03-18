<?php
class EtudiantTable extends UtilisateurTable
{
    public static string $PROMOTION_COLUMN = "IdPromotion";
    public static string $ADRESSE_COLUMN = "IdAdresse";

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

    public function getEtudiantTable($db): EtudiantTable
    {
        $instance = new EtudiantTable();
        $this->setDatabase($db);
        $this->setTable("Etudiant");
        return $instance;
    }
}