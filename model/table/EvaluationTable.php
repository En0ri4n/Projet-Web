<?php

namespace model\table;

use model\object\Evaluation;
use model\object\SerializableObject;

class EvaluationTable extends AbstractTable
{
    public static string $ID_COLUMN = "Evaluation.IdEvaluation";
    public static string $NOTE_COLUMN = "Evaluation.Note";
    public static string $COMMENTAIRE_COLUMN = "Evaluation.Commentaire";
    public static string $ID_UTILISATEUR_COLUMN = "Evaluation.IdUtilisateur";
    public static string $ID_ENTREPRISE_COLUMN = "Evaluation.IdEntreprise";

    public function __construct()
    {
        parent::__construct("Evaluation");
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): null|array|Evaluation
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Evaluation::fromArray');
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