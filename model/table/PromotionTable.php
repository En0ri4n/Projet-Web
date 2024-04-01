<?php

namespace model\table;

use model\object\Promotion;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');

class PromotionTable extends AbstractTable
{
    public static string $ID_COLUMN = "Promotion.IdPromotion";
    public static string $NAME_COLUMN = "Promotion.NomPromotion";
    public static string $DATE_COLUMN = "Promotion.DatePromotion";
    public static string $LEVEL_COLUMN = "Promotion.NiveauPromotion";
    public static string $DURATION_COLUMN = "Promotion.DureePromotion";
    public static string $CENTER_COLUMN = "Promotion.Centre";
    public static string $PILOT_COLUMN = "Promotion.Pilote";

    public function __construct() { parent::__construct('Promotion'); }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): array|Promotion|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Promotion::fromArray');
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
        return self::$ID_COLUMN;
    }
}