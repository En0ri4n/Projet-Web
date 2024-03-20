<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class Etudiant extends Utilisateur
{
    public static Etudiant $EMPTY_ETUDIANT;

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

    #[\Override]
    public function toArray(): array
    {
        return parent::toArray() + array(EtudiantTable::$PROMOTION_COLUMN => $this->idPromotion, EtudiantTable::$ADRESSE_COLUMN => $this->idAdresse);
    }

    public static function fromArray(array $array): Etudiant {
        /** @var Etudiant $etudiant */
        $etudiant = Utilisateur::fromArray($array);
        $etudiant->setIdPromotion($array[EtudiantTable::$PROMOTION_COLUMN]);
        $etudiant->setIdAdresse($array[EtudiantTable::$ADRESSE_COLUMN]);
        return $etudiant;
    }

    public static function getEmpty(): Etudiant
    {
        return $EMPTY_ETUDIANT ?? ($EMPTY_ETUDIANT = new Etudiant("", "", "", "", "", "", -1, -1));
    }
}