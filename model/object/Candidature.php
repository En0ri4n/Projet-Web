<?php

namespace model\object;

use model\table\CandidatureTable;

class Candidature extends SerializableObject
{
    private int $id;
    private string $cv_path;
    private string $cover_letter_path;
    private string $status;
    private string $id_etudiant;
    private int $id_offre;

    public function __construct(int $id, string $cv_path, string $cover_letter_path, string $status, string $id_etudiant, int $id_offre)
    {
        $this->id = $id;
        $this->cv_path = $cv_path;
        $this->cover_letter_path = $cover_letter_path;
        $this->status = $status;
        $this->id_etudiant = $id_etudiant;
        $this->id_offre = $id_offre;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCvPath(): string
    {
        return $this->cv_path;
    }

    public function getCoverLetterPath(): string
    {
        return $this->cover_letter_path;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getIdEtudiant(): string
    {
        return $this->id_etudiant;
    }

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }


    public function toArray(): array
    {
        return [
            CandidatureTable::$ID_COLUMN => $this->id,
            CandidatureTable::$CV_PATH_COLUMN => $this->cv_path,
            CandidatureTable::$COVER_LETTER_PATH_COLUMN => $this->cover_letter_path,
            CandidatureTable::$STATUS_COLUMN => $this->status,
            CandidatureTable::$ID_ETUDIANT_COLUMN => $this->id_etudiant,
            CandidatureTable::$ID_OFFRE_COLUMN => $this->id_offre
        ];
    }

    public static function fromArray(array $array): Candidature
    {
        return new Candidature(
            $array[self::getColumnName(CandidatureTable::$ID_COLUMN)],
            $array[self::getColumnName(CandidatureTable::$CV_PATH_COLUMN)],
            $array[self::getColumnName(CandidatureTable::$COVER_LETTER_PATH_COLUMN)],
            $array[self::getColumnName(CandidatureTable::$STATUS_COLUMN)],
            $array[self::getColumnName(CandidatureTable::$ID_ETUDIANT_COLUMN)],
            $array[self::getColumnName(CandidatureTable::$ID_OFFRE_COLUMN)]
        );
    }
}