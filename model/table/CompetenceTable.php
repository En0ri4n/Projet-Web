<?php

namespace model\table;

use model\object\Competence;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Competence.php');

class CompetenceTable extends AbstractTable
{
    public static string $ID_COLUMN = 'Competence.IdCompetence';
    public static string $NOM_COLUMN = 'Competence.NomCompetence';

    public function __construct()
    {
        parent::__construct('Competence');
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): array|Competence|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Competence::fromArray($a));
    }

    public function selectOr(array $conditions): array|Competence|null
    {
        return parent::defaultSelectOr(self::no_join(), $conditions, fn($a) => Competence::fromArray($a));
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