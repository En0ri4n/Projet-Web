<?php

namespace model\table;

use model\object\Link;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Link.php');

class LinkTable extends AbstractTable
{
    private string $id_from_column;
    private string $id_to_column;

    private function __construct(string $table, string $id_from_column, string $id_to_column)
    {
        parent::__construct($table);
        $this->id_from_column = $id_from_column;
        $this->id_to_column = $id_to_column;
    }

    public function getIdFromColumn(): string
    {
        return $this->id_from_column;
    }

    public function getIdToColumn(): string
    {
        return $this->id_to_column;
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): null|array|Link
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Link::linkFromArray($this, $a));
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
        return $this->getIdFromColumn();
    }

    public static function getEntrepriseToSecteur(): LinkTable
    {
        return new LinkTable('Composer', 'IdEntreprise', 'IdSecteur');
    }

    public static function getOffreToCompetence(): LinkTable
    {
        return new LinkTable('Demander', 'IdOffre', 'IdCompetence');
    }

    public static function getEntrepriseToAdresse(): LinkTable
    {
        return new LinkTable('Localiser', 'IdEntreprise', 'IdAdresse');
    }
}