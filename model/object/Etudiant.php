<?php

namespace model\object;

use EtudiantTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');

class Etudiant extends Utilisateur implements SerializableInterface
{
    private int $idPromotion;
    private int $idAdresse;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $motDePasse, string $telephone, int $idPromotion, int $idAdresse)
    {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse, $telephone);
        $this->idPromotion = $idPromotion;
        $this->idAdresse = $idAdresse;
    }

    public function getIdPromotion(): int
    {
        return $this->idPromotion;
    }

    public function getIdAdresse(): int
    {
        return $this->idAdresse;
    }

    public function setIdPromotion(int $idPromotion): void
    {
        $this->idPromotion = $idPromotion;
    }

    public function setIdAdresse(int $idAdresse): void
    {
        $this->idAdresse = $idAdresse;
    }

    public function toArray(): array
    {
        return parent::toArray() + array(explode('.', EtudiantTable::$PROMOTION_COLUMN)[1] => $this->idPromotion, explode('.', EtudiantTable::$ADRESSE_COLUMN)[1] => $this->idAdresse);
    }

    public static function fromArray(array $array): Etudiant
    {
        return self::from(Utilisateur::fromArray($array), $array[explode('.', EtudiantTable::$PROMOTION_COLUMN)[1]], $array[explode('.', EtudiantTable::$ADRESSE_COLUMN)[1]]);
    }

    private static function from(Utilisateur $utilisateur, ?int $idPromotion, ?int $idAdresse): Etudiant
    {
        return new Etudiant($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone(), $idPromotion ?? -1, $idAdresse ?? -1);
    }
}