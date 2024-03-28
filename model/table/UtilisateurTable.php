<?php
/** @noinspection DuplicatedCode */

namespace model\table;

use model\object\Utilisateur;
use model\object\SerializableInterface;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');

class UtilisateurTable extends AbstractTable
{
    public static string $TABLE_NAME = 'Utilisateur';

    public static string $ID_COLUMN = "Utilisateur.IdUtilisateur";
    public static string $NOM_COLUMN = "Utilisateur.Nom";
    public static string $PRENOM_COLUMN = "Utilisateur.Prenom";
    public static string $EMAIL_COLUMN = "Utilisateur.MailUtilisateur";
    public static string $PASSWORD_COLUMN = "Utilisateur.MotDePasse";
    public static string $TELEPHONE_COLUMN = "Utilisateur.TelephoneUtilisateur";

    public function __construct() { parent::__construct(self::$TABLE_NAME); }

    public function insert(SerializableInterface $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function delete(mixed $id): bool
    {
        return $this->defaultDelete($id);
    }

    public function select(array $conditions): array|Utilisateur|null
    {
        return $this->defaultSelect(self::no_join(), $conditions, 'model\object\Utilisateur::fromArray');
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        return $this->defaultUpdate($id, $columns, $values);
    }

    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }
}