<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class Pilote extends Utilisateur
{
    public static Pilote $EMPTY_PILOTE;

    public function __construct($id, $nom, $prenom, $email, $password, $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
    }

    public static function fromArray(array $array): Pilote
    {
        return new Pilote($array[PiloteTable::$ID_COLUMN],
            $array[PiloteTable::$NOM_COLUMN],
            $array[PiloteTable::$PRENOM_COLUMN],
            $array[PiloteTable::$EMAIL_COLUMN],
            $array[PiloteTable::$PASSWORD_COLUMN],
            $array[PiloteTable::$TELEPHONE_COLUMN]);
    }

    public static function getEmpty(): Pilote
    {
        return $EMPTY_PILOTE ?? ($EMPTY_PILOTE = new Pilote("", "", "", "", "", ""));
    }
}