<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class Tables
{
    public static UtilisateurTable $UTILISATEUR_TABLE;
    public static EtudiantTable $ETUDIANT_TABLE;
    public static PiloteTable $PILOTE_TABLE;

    public static Tables $TABLES;

    /**
     * Check if the given id is an etudiant
     *
     * @param mixed $id The id to check
     * @return bool True if the id is an etudiant, false otherwise
     */
    public function isEtudiant(mixed $id): bool
    {
        return self::$ETUDIANT_TABLE->selectEtudiant([EtudiantTable::$ID_COLUMN => $id]) !== Etudiant::getEmpty();
    }

    /**
     * Check if the given id is a pilote
     *
     * @param mixed $id The id to check
     * @return bool True if the id is a pilote, false otherwise
     */
    public function isPilote(mixed $id): bool
    {
        return self::$PILOTE_TABLE->selectPilote([PiloteTable::$ID_COLUMN => $id]) !== Pilote::getEmpty();
    }

    /**
     * Get and initialize the tables if they are not already
     *
     * @return Tables
     */
    public static function get(): Tables
    {
        global $pdo;

        if(!isset(self::$UTILISATEUR_TABLE))
            self::$UTILISATEUR_TABLE = UtilisateurTable::getUtilisateurTable($pdo);

        if(!isset(self::$ETUDIANT_TABLE))
            self::$ETUDIANT_TABLE = EtudiantTable::getEtudiantTable($pdo);

        if(!isset(self::$PILOTE_TABLE))
            self::$PILOTE_TABLE = PiloteTable::getPiloteTable($pdo);

        if(!isset(self::$TABLES))
            self::$TABLES = new Tables();

        return self::$TABLES;
    }
}