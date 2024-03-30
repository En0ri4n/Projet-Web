<?php
/** @noinspection DuplicatedCode */

namespace model\table;

use model\object\Offre;
use model\object\SerializableObject;
use PDO;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Offre.php');

class OffreTable extends AbstractTable
{
    public static string $ID_COLUMN = "Offre.IdOffre";
    public static string $NAME_COLUMN = "Offre.NomOffre";
    public static string $DATE_COLUMN = "Offre.DateOffre";
    public static string $DURATION_COLUMN = "Offre.DureeOffre";
    public static string $COMPENSATION_COLUMN = "Offre.Remuneration";
    public static string $NBPLACE_COLUMN = "Offre.NbPlace";
    public static string $LEVEL_COLUMN = "Offre.NiveauOffre";
    public static string $DESCRIPTION_COLUMN = "Offre.DescriptionOffre";
    public static string $SECTOR_COLUMN = "Offre.IdSecteur";
    public static string $ADDRESS_COLUMN = "Offre.IdAdresse";
    public static string $COMPANY_COLUMN = "Offre.IdEntreprise";

    public function __construct() { parent::__construct('Offre'); }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function delete(mixed $id): bool
    {
        $query = "DELETE FROM " . $this->getTableName() . " LEFT JOIN Wishlist WHERE Wishlist.IdOffre = " . $this->getIdColumn() . " AND " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function select(array $conditions): array|Offre|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Offre::fromArray');
    }

    public function selectLike(array $conditions): array|Offre|null
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return Offre::fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => Offre::fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " LIKE :" . $this->escape_and_lower($key)), array_keys($conditions)));

        $stmt = $this->getDatabase()->prepare($query);

        foreach($conditions as $key => $value)
        {
            $stmt->bindValue(':' . $this->escape_and_lower($key), $value);
        }

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return Offre::fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => Offre::fromArray($row)), $rows);

        return null;
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    protected function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }
    
}


