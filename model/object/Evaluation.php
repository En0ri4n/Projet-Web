<?php

namespace model\object;

use model\table\EvaluationTable;

class Evaluation extends SerializableObject
{
    private int $id;
    private int $note;
    private string $commentaire;
    private int $id_utilisateur;
    private int $id_entreprise;

    public function __construct(int $id, int $note, string $commentaire, int $id_utilisateur, int $id_entreprise)
    {
        $this->id = $id;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_entreprise = $id_entreprise;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    public function getIdUtilisateur(): int
    {
        return $this->id_utilisateur;
    }

    public function getIdEntreprise(): int
    {
        return $this->id_entreprise;
    }

    public function toArray(): array
    {
        return [
            self::getColumnName(EvaluationTable::$ID_COLUMN) => $this->id,
            self::getColumnName(EvaluationTable::$NOTE_COLUMN) => $this->note,
            self::getColumnName(EvaluationTable::$COMMENTAIRE_COLUMN) => $this->commentaire,
            self::getColumnName(EvaluationTable::$ID_UTILISATEUR_COLUMN) => $this->id_utilisateur,
            self::getColumnName(EvaluationTable::$ID_ENTREPRISE_COLUMN) => $this->id_entreprise
        ];
    }

    public function toInsertArray(): array
    {
        return [
            self::getColumnName(EvaluationTable::$NOTE_COLUMN) => $this->note,
            self::getColumnName(EvaluationTable::$COMMENTAIRE_COLUMN) => $this->commentaire,
            self::getColumnName(EvaluationTable::$ID_UTILISATEUR_COLUMN) => $this->id_utilisateur,
            self::getColumnName(EvaluationTable::$ID_ENTREPRISE_COLUMN) => $this->id_entreprise
        ];
    }

    public static function fromArray(array $array): Evaluation
    {
        return new Evaluation(
            $array[self::getColumnName(EvaluationTable::$ID_COLUMN)],
            $array[self::getColumnName(EvaluationTable::$NOTE_COLUMN)],
            $array[self::getColumnName(EvaluationTable::$COMMENTAIRE_COLUMN)],
            $array[self::getColumnName(EvaluationTable::$ID_UTILISATEUR_COLUMN)],
            $array[self::getColumnName(EvaluationTable::$ID_ENTREPRISE_COLUMN)]
        );
    }
}