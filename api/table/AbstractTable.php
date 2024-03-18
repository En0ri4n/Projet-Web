<?php
namespace Table;

use Exception;
use PDO;
use PDOStatement;

include_once 'object/Utilisateur.php';

abstract class AbstractTable
{
    /**
     * @var PDO The database to use
     */
    private PDO $db;

    /**
     * @var string The name of the table
     */
    private string $table_name;

    /**
     * Add a new row to the table
     *
     * @param array $columns The columns to insert
     * @param array $values The values to insert (in the same order as the columns)
     * @return bool True if the insert was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    public function insert(array $columns, array $values): bool
    {
        $this->verifyArray($columns, fn($array) => count($array) != count($values), "Columns and values do not have the same length");

        $query = "INSERT INTO " . $this->table_name . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_map((fn($column) => ":" . $column), $columns)) . ")";
        $stmt = $this->db->prepare($query);
        foreach($columns as $column)
            $stmt->bindParam(':' . $column, $values[$column]);
        if($stmt->execute())
            return true;
        return false;
    }

    /**
     * Select one or more rows from the table with the given column keys and values
     *
     * @param array $columns The columns to select
     * @param array $map Associative array of column keys and values to select
     * @return PDOStatement The result of the select
     * @throws Exception if the columns and values do not have the same length or if the columns array is too long
     */
    public function select(array $columns, array $map): PDOStatement
    {
        $this->verifyArray($columns, fn($array) => count($array) > $this->getColumnCount(), "Too many columns");

        $query = "SELECT " . (empty($columns) ? "*" : implode(", ", $columns)) . " FROM " . $this->table_name;

        if(empty($map))
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " = :" . strtolower($key)), array_keys($map)));
        $stmt = $this->db->prepare($query);
        foreach($map as $key => $value)
            $stmt->bindValue(':' . strtolower($key), $value);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Select from the table with special conditions
     *
     * @param array $columns The columns to select
     * @param array $conditions The conditions to apply to the select (e.g. "id = 1")
     * @return PDOStatement The result of the select
     */
    public function selectSpecialConditions(array $columns, array $conditions): PDOStatement
    {
        $query = "SELECT " . implode(", ", $columns) . " FROM " . $this->table_name . " WHERE " . implode(" AND ", $conditions);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Update the row with the given id
     *
     * @param mixed $id The id of the row to update
     * @param array $columns The columns to update
     * @param array $values The values to update (in the same order as the columns)
     * @return bool True if the update was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    public function update(mixed $id, array $columns, array $values): bool
    {
        $this->verifyArray($columns, fn($array) => count($array) != count($values), "Columns and values do not have the same length");

        $query = "UPDATE " . $this->table_name . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $column), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        foreach($columns as $column)
            $stmt->bindParam(':' . $column, $values[$column]);
        if($stmt->execute())
            return true;
        return false;
    }

    /**
     * Delete the row with the given id
     *
     * @param mixed $id The id of the row to delete
     * @return bool True if the delete was successful, false otherwise
     */
    public function delete(mixed $id): bool
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * @return string The name of the id column
     */
    abstract protected function getIdColumn(): string;

    /**
     * @return int The number of columns in the table (used for input verification)
     */
    abstract protected function getColumnCount(): int;

    /**
     * Set the table name for the instance
     *
     * @param string $table_name The name of the table
     * @return void
     */
    protected function setTable(string $table_name): void
    {
        $this->table_name = $table_name;
    }

    /**
     * Set the database for the instance
     *
     * @param PDO $db The database to use
     * @return void
     */
    protected function setDatabase(PDO $db): void
    {
        $this->db = $db;
    }

    /**
     * Verify that the array passes the given check
     *
     * @throws Exception
     */
    protected function verifyArray(array $array, callable $lengthFunction, string $message): void
    {
        if($lengthFunction($array))
            throw new Exception("Array is not validating the check");
    }

    protected function getDatabase(): PDO
    {
        return $this->db;
    }
}
