<?php

namespace model\object;

use EtudiantTable;
use model\table\AdresseTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');

class Etudiant extends Utilisateur
{
    protected string $id;
    private int $idPromotion;
    private int $idAdresse;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $motDePasse, string $telephone, int $idPromotion, int $idAdresse)
    {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse, $telephone);
        $this->id = $id;
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
        return parent::toArray() + array(self::getColumnName(EtudiantTable::$PROMOTION_COLUMN) => $this->idPromotion, self::getColumnName(EtudiantTable::$ADRESSE_COLUMN) => $this->idAdresse);
    }

    public function toInsertArray(): array
    {
        return array(self::getColumnName(\EtudiantTable::$ID_COLUMN) => $this->id, self::getColumnName(EtudiantTable::$PROMOTION_COLUMN) => $this->idPromotion, self::getColumnName(EtudiantTable::$ADRESSE_COLUMN) => $this->idAdresse);
    }

    public static function fromArray(array $array): Etudiant
    {
        return self::from(Utilisateur::fromArray($array), $array[self::getColumnName(EtudiantTable::$PROMOTION_COLUMN)], $array[self::getColumnName(EtudiantTable::$ADRESSE_COLUMN)]);
    }

    private static function from(Utilisateur $utilisateur, ?int $idPromotion, ?int $idAdresse): Etudiant
    {
        return new Etudiant($utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getEmail(), $utilisateur->getPassword(), $utilisateur->getTelephone(), $idPromotion ?? -1, $idAdresse ?? -1);
    }
}