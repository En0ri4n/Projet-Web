<?php
/** @noinspection ALL */

include_once($_SERVER['DOCUMENT_ROOT'] . '/api/config.php');

abstract class AbstractTable
{
    /**
     * @var string The name of the table
     */
    private string $table_name;

    protected function __construct(string $table_name)
    {
        $this->table_name = $table_name;
    }

    /**
     * Add a new row to the table
     *
     * @param mixed $obj The object to insert
     * @return bool True if the insert was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    public abstract function insert(mixed $obj): bool;

    protected function insertWith(array $columns, array $values): bool
    {
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_map((fn($column) => ":" . $column), $columns)) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($columns as $column)
            $stmt->bindParam(':' . $column, $values[$column]);
        return $stmt->execute();
    }

    /**
     * Select one or more rows from the table with the given column keys and values
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return mixed The result of the select (e.g. an object or an array of objects)
     */
    public abstract function select(array $conditions): mixed;

    /**
     * Select from the table with special conditions
     *
     * @param array $columns The columns to select
     * @param array $conditions The conditions to apply to the select (e.g. "id = 1")
     * @return PDOStatement|null The result of the select
     * @throws Exception if the function is not implemented
     */
    public function selectSpecialConditions(array $columns, array $conditions): mixed { throw new Exception("Not Implemented"); }

    /**
     * Update the row with the given id
     *
     * @param mixed $id The id of the row to update
     * @param array $columns The columns to update
     * @param array $values The values to update (in the same order as the columns)
     * @return bool True if the update was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    public abstract function update(mixed $id, array $columns, array $values): bool;

    /**
     * Delete the row with the given id
     *
     * @param mixed $id The id of the row to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public abstract function delete(mixed $id): bool;

    /**
     * @return string The name of the id column
     */
    abstract protected function getIdColumn(): string;

    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @return int The number of columns in the table (used for input verification)
     */
    abstract protected function getColumnCount(): int;

    /**
     * @return PDO The database to use
     */
    protected function getDatabase(): PDO
    {
        return Database::getDatabase();
    }

    /**
     * Verify that the array passes the given check
     *
     * @throws Exception if the array does not pass the check
     */
    protected function verifyArray(array $array, callable $lengthFunction, string $message): void
    {
        if($lengthFunction($array))
            throw new Exception($message);
    }

    protected function escape_and_lower(string $input): string
    {
        return $replace = strtolower(str_replace(".", "", $input));
    }
}
