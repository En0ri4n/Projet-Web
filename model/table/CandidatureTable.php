<?php

namespace model\table;

use model\object\Candidature;
use model\object\SerializableObject;

class CandidatureTable extends AbstractTable
{
    public static string $ID_COLUMN = 'Candidature.IdCandidature';
    public static string $CV_PATH_COLUMN = 'Candidature.CV';
    public static string $COVER_LETTER_PATH_COLUMN = 'Candidature.LettreMotivation';
    public static string $STATUS_COLUMN = 'Candidature.StatutCandidature';
    public static string $ID_ETUDIANT_COLUMN = 'Candidature.IdEtudiant';
    public static string $ID_OFFRE_COLUMN = 'Candidature.IdOffre';

    public function __construct()
    {
        parent::__construct('Candidature');
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): array|null|Candidature
    {
        return $this->defaultSelect(self::no_join(), $conditions, fn($a) => Candidature::fromArray($a));
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