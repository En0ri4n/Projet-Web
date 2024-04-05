<?php

namespace model\object;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');

class Pilote extends Utilisateur
{
    protected string $id;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $password, string $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
        $this->id=$id;
    }

    public static function fromArray(array $array): Pilote
    {
        return self::from(Utilisateur::fromArray($array));
    }

    private static function from(Utilisateur $utilisateur): Pilote
    {
        return new Pilote($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone());
    }

    public function toInsertArray(): array
    {
        return array(self::getColumnName(\AdministrateurTable::$ID_COLUMN) => $this->id);
    }
}