<?php

namespace Table;

use Exception;
use Object\Pilote;

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

    public function getPiloteTable($db): PiloteTable
    {
        $instance = new PiloteTable();
        $this->setDatabase($db);
        $this->setTable("Pilote");
        return $instance;
    }
}