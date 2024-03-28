<?php

namespace model\object;

use model\table\UtilisateurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');

class Utilisateur implements SerializableInterface
{
    protected string $id;
    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $motDePasse;
    protected string $telephone;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $motDePasse, string $telephone)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->telephone = $telephone;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->motDePasse;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function toArray(): array
    {
        return array(explode('.', UtilisateurTable::$ID_COLUMN)[1] => $this->id, explode('.', UtilisateurTable::$NOM_COLUMN)[1] => $this->nom, explode('.', UtilisateurTable::$PRENOM_COLUMN)[1] => $this->prenom, explode('.', UtilisateurTable::$EMAIL_COLUMN)[1] => $this->email, explode('.', UtilisateurTable::$PASSWORD_COLUMN)[1] => $this->motDePasse, explode('.', UtilisateurTable::$TELEPHONE_COLUMN)[1] => $this->telephone);
    }

    public static function fromArray(array $array): Utilisateur
    {
        return new Utilisateur($array[explode('.', UtilisateurTable::$ID_COLUMN)[1]], $array[explode('.', UtilisateurTable::$NOM_COLUMN)[1]], $array[explode('.', UtilisateurTable::$PRENOM_COLUMN)[1]], $array[explode('.', UtilisateurTable::$EMAIL_COLUMN)[1]], $array[explode('.', UtilisateurTable::$PASSWORD_COLUMN)[1]], $array[explode('.', UtilisateurTable::$TELEPHONE_COLUMN)[1]]);
    }
}