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
        $query = "DELETE " . $this->getTableName() . ", Wishlist FROM " . $this->getTableName() . " LEFT JOIN Wishlist ON Wishlist.IdOffre = " . $this->getIdColumn() . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        /* Candidatures à l'offre */
        $query = "DELETE FROM Candidature WHERE IdOffre = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function select(array $conditions): array|Offre|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Offre::fromArray($a));
    }

    public function selectSpecialConditions(array $conditions, callable $fromArray): mixed
    {
        return parent::selectSpecialConditions($conditions, $fromArray);
    }

    public function selectSpecialConditionsAndParameters(array $conditions, string $parameters, callable $fromArray): array|Offre|null
    {
        return parent::selectSpecialConditionsAndParameters($conditions, $parameters, $fromArray);
    }

    public function selectLike(array $conditions, callable $fromArray): array|Offre|null
    {
        return parent::selectLike($conditions, $fromArray);
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    public function updateJoin(mixed $id, string $join_query, array $values): bool
    {

        return $this->defaultJoinUpdate($id, $join_query, $values);
    }

    protected function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }
    
}


