<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

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
        $created = self::getUtilisateurTable($this->getDatabase())->insertUtilisateur($pilote);
        $created &= $this->insert([self::$ID_COLUMN], [$pilote->getId()]);
        return $created;
    }

    /**
     * Select a pilote from the database
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return Pilote The pilote selected or an empty pilote if the query fails
     */
    public function selectPilote(array $conditions): Pilote
    {
        try
        {
            $stmt = $this->select($conditions);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? Pilote::fromArray($row) : Pilote::getEmpty();
        }
        catch (Exception $e)
        {
            return Pilote::getEmpty();
        }
    }

    /**
     * Get the pilote table
     *
     * @param mixed $db The database to use
     * @return PiloteTable The pilote table
     */
    public static function getPiloteTable(mixed $db): PiloteTable
    {
        $instance = new PiloteTable();
        $instance->setDatabase($db);
        $instance->setTable("Pilote");
        return $instance;
    }
}