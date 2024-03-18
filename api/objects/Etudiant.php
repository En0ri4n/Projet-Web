<?php

class Etudiant extends Utilisateur
{
    private string $idPromotion;
    private string $idAdresse;

    public function __construct(string $id, string $nom, string $prenom, string $email, string $motDePasse, string $telephone, string $idPromotion, string $idAdresse)
    {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse, $telephone);
        $this->idPromotion = $idPromotion;
        $this->idAdresse = $idAdresse;
    }

    public function getIdPromotion(): string
    {
        return $this->idPromotion;
    }

    public function getIdAdresse(): string
    {
        return $this->idAdresse;
    }

    public function setIdPromotion(string $idPromotion): void
    {
        $this->idPromotion = $idPromotion;
    }

    public function setIdAdresse(string $idAdresse): void
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
}