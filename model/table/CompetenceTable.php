<?php

namespace model\table;

use model\object\Competence;
use model\object\SerializableObject;

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

    public function select(array $conditions): null|array|Competence
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Competence::fromArray');
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