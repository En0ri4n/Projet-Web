<?php


namespace table;

use object\Pilote;

class PiloteTable extends UtilisateurTable
{
    /**
     * Create a new pilote in the database
     *
     * @param Pilote $pilote The pilote to create
     * @return bool True if the pilote was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    public function insertPilote(Pilote $pilote): bool
    {
        $created = self::getUtilisateurTable()->insertUtilisateur($pilote);
        $created &= $this->insert([self::$ID_COLUMN], [$pilote->getId()]);
        return $created;
    }

    /**
     * Select a pilote from the database
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return Pilote|null The pilote selected or an empty pilote if the query fails
     */
    public function selectPilote(array $conditions): Pilote|null
    {
        try
        {
            $stmt = $this->select($conditions);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? Pilote::fromArray($row) : null;
        }
        catch(Exception $e)
        {
            return null;
        }
    }

    /**
     * Get the pilote table
     *
     * @return PiloteTable The pilote table
     */
    public static function getPiloteTable(): PiloteTable
    {
        $instance = new PiloteTable();
        $instance->setTable("Pilote");
        return $instance;
    }
}