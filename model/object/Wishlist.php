<?php

namespace model\object;

use model\table\WishlistTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');

class Wishlist extends SerializableObject
{
    private string $id_utilisateur;
    private int $offres;

    public function __construct(string $id_utilisateur, int $offres)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->offres = $offres;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(WishlistTable::$ID_UTILISATEUR_COLUMN) => $this->id_utilisateur,
            self::getColumnName(WishlistTable::$ID_OFFRE_COLUMN) => $this->offres
        ];
    }

    public function toInsertArray(): array
    {
        return [
            self::getColumnName(WishlistTable::$ID_UTILISATEUR_COLUMN) => $this->id_utilisateur,
            self::getColumnName(WishlistTable::$ID_OFFRE_COLUMN) => $this->offres
        ];
    }

    public static function fromArray(array $array): Wishlist
    {
        return new Wishlist($array[self::getColumnName(WishlistTable::$ID_UTILISATEUR_COLUMN)], $array[self::getColumnName(WishlistTable::$ID_OFFRE_COLUMN)]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}