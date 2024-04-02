<?php

namespace model\table;

use model\object\SerializableObject;
use model\object\Wishlist;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Wishlist.php');

class WishlistTable extends AbstractTable
{
    public static string $ID_UTILISATEUR_COLUMN = 'idUtilisateur';
    public static string $ID_OFFRE_COLUMN = 'idOffre';

    public function __construct()
    {
        parent::__construct('Wishlist');
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): null|array|Wishlist
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Wishlist::fromArray($a));
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    public function delete(mixed $id): bool
    {
        return $this->defaultDelete($id);
    }

    protected function getIdColumn(): string
    {
        return self::$ID_UTILISATEUR_COLUMN;
    }
}
