<?php

namespace model\table;

use model\object\Entreprise;
use model\object\SerializableObject;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Entreprise.php');

class EntrepriseTable extends AbstractTable
{
    public static string $ID_COLUMN = 'Entreprise.IdEntreprise';
    public static string $NOM_COLUMN = 'Entreprise.NomEntreprise';
    public static string $SITE_COLUMN = 'Entreprise.Site';
    public static string $DESCRIPTION_COLUMN = 'Entreprise.DescriptionEntreprise';
    public static string $EMAIL_COLUMN = 'Entreprise.MailEntreprise';
    public static string $TELEPHONE_COLUMN = 'Entreprise.TelephoneEntreprise';
    public static string $STATUS_COLUMN = 'Entreprise.Statut';

    public function __construct()
    {
        parent::__construct('Entreprise');
    }

    public function insert(SerializableObject $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function select(array $conditions): null|array|Entreprise
    {
        return $this->defaultSelect(self::left_join('Composer', 'IdEntreprise','IdEntreprise'), $conditions, fn($a) => Entreprise::fromArray($a));
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