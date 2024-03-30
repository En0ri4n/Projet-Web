<?php

namespace model\object;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');

class Administrateur extends Utilisateur
{
    public static string $ID_COLUMN = "Administrateur.IdUtilisateur";

    public function __construct($id, $nom, $prenom, $email, $password, $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
    }

    public static function fromArray(array $array): Administrateur
    {
        return self::from(Utilisateur::fromArray($array));
    }

    private static function from(Utilisateur $utilisateur): Administrateur
    {
        return new Administrateur($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone());
    }
}