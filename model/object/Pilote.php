<?php


namespace object;

class Pilote extends Utilisateur
{
    public static string $ID_COLUMN = "Pilote.IdUtilisateur";

    public function __construct($id, $nom, $prenom, $email, $password, $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
    }

    public static function fromArray(array $array): Pilote
    {
        return self::from(Utilisateur::fromArray($array));
    }

    private static function from(Utilisateur $utilisateur): Pilote
    {
        return new Pilote($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone());
    }
}