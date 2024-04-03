<?php

namespace model\object;

use model\table\PromotionTable;

class Promotion extends SerializableObject
{
    private int $id_promotion;
    private string $nom;
    private string $type;
    private string $date_debut;
    private int $niveau;
    private int $duree;
    private string $centre;
    private string $id_pilote;

    public function __construct(int $id_promotion, string $nom, string $type, string $date_debut, int $niveau, int $duree, string $centre, string $pilote)
    {
        $this->id_promotion = $id_promotion;
        $this->nom = $nom;
        $this->type = $type;
        $this->date_debut = $date_debut;
        $this->niveau = $niveau;
        $this->duree = $duree;
        $this->centre = $centre;
        $this->id_pilote = $pilote;
    }

    public function getIdPromotion(): int
    {
        return $this->id_promotion;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDateDebut(): string
    {
        return $this->date_debut;
    }

    public function getNiveau(): int
    {
        return $this->niveau;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getCentre(): string
    {
        return $this->centre;
    }

    public function getIdPilote(): string
    {
        return $this->id_pilote;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(PromotionTable::$ID_COLUMN) => $this->id_promotion,
            self::getColumnName(PromotionTable::$NAME_COLUMN) => $this->nom,
            self::getColumnName(PromotionTable::$TYPE_COLUMN) => $this->type,
            self::getColumnName(PromotionTable::$DATE_COLUMN) => $this->date_debut,
            self::getColumnName(PromotionTable::$LEVEL_COLUMN) => $this->niveau,
            self::getColumnName(PromotionTable::$DURATION_COLUMN) => $this->duree,
            self::getColumnName(PromotionTable::$CENTER_COLUMN) => $this->centre,
            self::getColumnName(PromotionTable::$PILOT_COLUMN) => $this->id_pilote
        ];
    }

    public function toInsertArray(): array
    {
        return [
            self::getColumnName(PromotionTable::$NAME_COLUMN) => $this->nom,
            self::getColumnName(PromotionTable::$TYPE_COLUMN) => $this->type,
            self::getColumnName(PromotionTable::$DATE_COLUMN) => $this->date_debut,
            self::getColumnName(PromotionTable::$LEVEL_COLUMN) => $this->niveau,
            self::getColumnName(PromotionTable::$DURATION_COLUMN) => $this->duree,
            self::getColumnName(PromotionTable::$CENTER_COLUMN) => $this->centre,
            self::getColumnName(PromotionTable::$PILOT_COLUMN) => $this->id_pilote
        ];
    }

    public static function fromArray(array $array): Promotion
    {
        return new Promotion(
            $array[self::getColumnName(PromotionTable::$ID_COLUMN)],
            $array[self::getColumnName(PromotionTable::$NAME_COLUMN)],
            $array[self::getColumnName(PromotionTable::$TYPE_COLUMN)],
            $array[self::getColumnName(PromotionTable::$DATE_COLUMN)],
            $array[self::getColumnName(PromotionTable::$LEVEL_COLUMN)],
            $array[self::getColumnName(PromotionTable::$DURATION_COLUMN)],
            $array[self::getColumnName(PromotionTable::$CENTER_COLUMN)],
            $array[self::getColumnName(PromotionTable::$PILOT_COLUMN)]
        );
    }
}