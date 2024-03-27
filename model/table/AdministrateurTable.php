<?php

namespace table;

class AdministrateurTable extends AbstractTable
{
    public static string $ID_COLUMN = "Utilisateur.IdUtilisateur";
    public static string $NOM_COLUMN = "Utilisateur.Nom";
    public static string $PRENOM_COLUMN = "Utilisateur.Prenom";
    public static string $EMAIL_COLUMN = "Utilisateur.MailUtilisateur";
    public static string $PASSWORD_COLUMN = "Utilisateur.MotDePasse";
    public static string $TELEPHONE_COLUMN = "Utilisateur.TelephoneUtilisateur";

    public function __construct($db)
    {
        parent::__construct('Administrateur', $db);
    }

    public function insert(mixed $obj): bool
    {
        // TODO: Implement insert() method.
    }

    public function select(array $conditions): mixed
    {
        // TODO: Implement select() method.
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(mixed $id): bool
    {
        // TODO: Implement delete() method.
    }

    protected function getIdColumn(): string
    {
        // TODO: Implement getIdColumn() method.
    }

    protected function getColumnCount(): int
    {
        // TODO: Implement getColumnCount() method.
    }
}