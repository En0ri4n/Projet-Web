<?php

namespace model\object;

use AdministrateurTable;
use EtudiantTable;
use model\table\AdresseTable;
use model\table\PromotionTable;
use model\table\UtilisateurTable;
use PiloteTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableObject.php');


class Utilisateur extends SerializableObject
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
        return array(
            self::getColumnName(UtilisateurTable::$ID_COLUMN) => $this->id,
            self::getColumnName(UtilisateurTable::$NOM_COLUMN) => $this->nom,
            self::getColumnName(UtilisateurTable::$PRENOM_COLUMN) => $this->prenom,
            self::getColumnName(UtilisateurTable::$EMAIL_COLUMN) => $this->email,
            self::getColumnName(UtilisateurTable::$PASSWORD_COLUMN) => $this->motDePasse,
            self::getColumnName(UtilisateurTable::$TELEPHONE_COLUMN) => $this->telephone
        );
    }

    public function toInsertArray(): array
    {
        return array(
            self::getColumnName(UtilisateurTable::$ID_COLUMN) => $this->id,
            self::getColumnName(UtilisateurTable::$NOM_COLUMN) => $this->nom,
            self::getColumnName(UtilisateurTable::$PRENOM_COLUMN) => $this->prenom,
            self::getColumnName(UtilisateurTable::$EMAIL_COLUMN) => $this->email,
            self::getColumnName(UtilisateurTable::$PASSWORD_COLUMN) => $this->motDePasse,
            self::getColumnName(UtilisateurTable::$TELEPHONE_COLUMN) => $this->telephone
        );
    }

    public function jsonSerialize(): array
    {
        $a = parent::jsonSerialize();

        unset($a[self::getColumnName(UtilisateurTable::$PASSWORD_COLUMN)]);

        if(EtudiantTable::isEtudiant($this->id))
        {
            $a['user_type'] = 'etudiant';

            $table = new EtudiantTable();
            $etudiant = $table->select([EtudiantTable::$ID_COLUMN => $this->id]);

            $table = new AdresseTable();
            $a['adresse'] = $table->select([AdresseTable::$ID_COLUMN => $etudiant->getIdAdresse()])->jsonSerialize();
        }
        elseif(AdministrateurTable::isAdministrateur($this->id))
        {
            $a['user_type'] = 'administrateur';
        }
        elseif(PiloteTable::isPilote($this->id))
        {
            $a['user_type'] = 'pilote';

            $table = new PiloteTable();
            $pilote = $table->select([PiloteTable::$ID_COLUMN => $this->id]);

            $table = new PromotionTable();
            $promos = $table->select([PromotionTable::$PILOT_COLUMN => $pilote->getId()]);
            $a['promotions'] = is_array($promos) ? $promos : [$promos];
        }

        return $a;
    }

    public static function fromArray(array $array): Utilisateur
    {
        return new Utilisateur(
            $array[self::getColumnName(UtilisateurTable::$ID_COLUMN)],
            $array[self::getColumnName(UtilisateurTable::$NOM_COLUMN)],
            $array[self::getColumnName(UtilisateurTable::$PRENOM_COLUMN)],
            $array[self::getColumnName(UtilisateurTable::$EMAIL_COLUMN)],
            $array[self::getColumnName(UtilisateurTable::$PASSWORD_COLUMN)],
            $array[self::getColumnName(UtilisateurTable::$TELEPHONE_COLUMN)]
        );
    }
}