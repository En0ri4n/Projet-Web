<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');

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
     * Add a new row to the table with the given SerializableInterface object
     *
     * @param SerializableInterface $obj The object to insert
     * @return bool True if the insert was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    public abstract function insert(SerializableInterface $obj): bool;

    /**
     * Insert a new row into the table with the given SerializableInterface object<br>
     * Default implementation
     */
    protected function defaultInsert(SerializableInterface $obj): bool
    {
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", array_map((fn($key) => $key), array_keys($obj->toArray()))) . ") VALUES (:" . implode(", :", array_keys($obj->toArray())) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($obj->toArray() as $key => $value)
            $stmt->bindValue(':' . $key, $value);
        return $stmt->execute();
    }

    /**
     * Insert a new row into the table with the given columns and values
     *
     * @param array $columns The columns to insert
     * @param array $values The values to insert (in the same order as the columns)
     * @return bool True if the insert was successful, false otherwise
     */
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
     * Select rows from the table with the given column keys and values<br>
     * Default implementation
     */
    protected function defaultSelect(array $conditions): mixed
    {
        try
        {
            $query = "SELECT * FROM " . $this->getTableName();
            if(empty($conditions))
            {
                $stmt = $this->getDatabase()->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return array_map((fn($row) => $this->fromArray($row)), $rows);
            }
            $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " = :" . $this->escape_and_lower($key)), array_keys($conditions)));
            $stmt = $this->getDatabase()->prepare($query);

            foreach($conditions as $key => $value)
                $stmt->bindValue(':' . $this->escape_and_lower($key), $value);

            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $this->fromArray($rows[0]);
            else if(count($rows) > 1)
                return array_map((fn($row) => $this->fromArray($row)), $rows);
        }
        catch(Exception $e)
        {
        }
        return null;
    }

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
     * Update the row with the given id<br>
     * Default implementation
     */
    protected function defaultUpdate(mixed $id, array $columns, array $values)
    {
        $query = "UPDATE " . $this->getTableName() . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $column), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($columns as $column)
            $stmt->bindParam(':' . $column, $values[$column]);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Delete the row with the given id
     *
     * @param mixed $id The id of the row to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public abstract function delete(mixed $id): bool;

    /**
     * Delete the row with the given id<br>
     * Default implementation
     */
    protected function defaultDelete(mixed $id): bool
    {
        $query = "DELETE FROM " . $this->getTableName() . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * @return string The name of the id column
     */
    abstract protected function getIdColumn(): string;

    public function getTableName(): string
    {
        return $this->table_name;
    }

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
