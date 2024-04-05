<?php
/** @noinspection DuplicatedCode */

use model\object\Adresse;
use model\object\Etudiant;
use model\table\AbstractTable;
use model\table\UtilisateurTable;
use model\table\AdresseTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AbstractTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Etudiant.php');

class EtudiantTable extends AbstractTable
{
    public static string $ID_COLUMN = "Etudiant.IdUtilisateur";
    public static string $PROMOTION_COLUMN = "Etudiant.IdPromotion";
    public static string $ADRESSE_COLUMN = "Etudiant.IdAdresse";

    public function __construct() { parent::__construct('Etudiant'); }

    /**
     * Select an etudiant from the database
     *
     * @param mixed $conditions Associative array of column keys and values to select
     * @return array|Etudiant|null The etudiant selected, a list of etudiants if multiple were found, or an empty etudiant if none were found
     */
    public function select(array $conditions): array|Etudiant|null
    {
        return $this->defaultSelect(self::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, self::$ID_COLUMN), $conditions, fn($a) => Etudiant::fromArray($a));
    }

    /**
     * Create a new etudiant in the database
     *
     * @return bool True if the etudiant was created, false otherwise
     * @throws Exception If the query fails or parameters are invalid
     */
    /* @throws Exception If the parameter is not an Etudiant
     * @var $obj Etudiant The etudiant to insert
     */

    /*TODO : Tester insert et update (avec commentaires pour suivre mon interpretation du code)*/
    public function insert(mixed $obj): bool
    {
        return $this->defaultInsert($obj);
    }

    public function update(mixed $id, array $columns, array $values): bool
    {
        $query = "UPDATE " . $this->getTableName() . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $column), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindParam(':id', $id);

        $conditions_adresse = array();
        $adresseEtudiantTable = new AdresseTable();

        foreach($columns as $column)
        {
            switch($column)
            {
                /*les données liées à l'adresse sont mises à part*/
                case "Numero":
                case "Rue":
                case "Ville":
                case "CodePostal":
                case "Pays":
                {
                    $conditions_adresse[$column] = $values[$column];
                }
                default:
                {
                    $stmt->bindValue(':' . $column, $values[$column]);
                }
            }
        }
        if(count($conditions_adresse) != 0)
        {
            /*Si il y a des données d'adresse*/
            /*Selection des données pour vérifier si elles sont déjà dans la BDD*/
            $adresse = $adresseEtudiantTable->select($conditions_adresse);
            if($adresse != null)
            {
                /*Si l'adresse existe on prend son l'Id et on le met dans  la requete Etudiant*/
                $stmt->bindValue(':IdAdresse', $adresse->getId());
            }
            else
            {
                /*Sinon, on l'insere et on prend l'Id de la donnée inserée pour la requete Etudiant*/
                $adresseEtudiant = Adresse::fromArray($conditions_adresse);
                $adresseEtudiantTable->defaultInsert($adresseEtudiant);
                $stmt->bindValue(':IdAdresse', $adresseEtudiantTable->getLastInsertId());
            }
        }

        if($stmt->execute())
            return true;
        return false;
    }

    public function delete(mixed $id): bool
    {
        /*Etudiant en lui-même*/
        $query = "DELETE " . $this->getTableName() . ", Utilisateur FROM " . $this->getTableName() . " INNER JOIN Utilisateur ON Utilisateur.IdUtilisateur = " . $this->getTableName() . ".IdUtilisateur WHERE Utilisateur.IdUtilisateur = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        /* Wishlist de l'etudiant */
        $query = "DELETE FROM Wishlist WHERE IdUtilisateur = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        /* Candidatures de l'etudiant */
        $query = "DELETE FROM Candidature WHERE IdEtudiant = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function getIdColumn(): string
    {
        return self::$ID_COLUMN;
    }

    public static function isEtudiant(mixed $userId): bool
    {
        $table = new EtudiantTable();
        $etudiant = $table->select([self::$ID_COLUMN => $userId]);
        return $etudiant !== null;
    }
}