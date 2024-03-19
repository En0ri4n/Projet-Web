<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class Tables
{
    public static UtilisateurTable $UTILISATEUR_TABLE;
    public static EtudiantTable $ETUDIANT_TABLE;
    public static PiloteTable $PILOTE_TABLE;

    public static Tables $TABLES;

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