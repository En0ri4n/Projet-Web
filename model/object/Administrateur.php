<?php

namespace model\object;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');

class Administrateur extends Utilisateur
{
    protected string $id;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $password, string $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
        $this->id=$id;
    }

    public static function fromArray(array $array): Administrateur
    {
        return self::from(Utilisateur::fromArray($array));
    }

    private static function from(Utilisateur $utilisateur): Administrateur
    {
        return new Administrateur($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone());
    }

    public function toInsertArray(): array
    {
        return array(self::getColumnName(\AdministrateurTable::$ID_COLUMN) => $this->id);
    }
}