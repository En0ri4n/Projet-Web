<?php

namespace model\object;

use model\table\WishlistTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');

class Wishlist extends SerializableObject
{
    private int $id_utilisateur;
    private array $offres;

    public function __construct(int $id_utilisateur, array $offres)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->offres = $offres;
    }

    /**
     * @return array
     */
    public function toArray(): array
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