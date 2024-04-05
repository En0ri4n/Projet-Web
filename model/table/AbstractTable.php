<?php

namespace model\table;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Database.php');

use Exception;
use model\object\SerializableInterface;
use model\Database;
use model\object\SerializableObject;
use PDO;
use PDOStatement;

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
     * @param SerializableObject $obj The object to insert
     * @return bool True if the insert was successful, false otherwise
     * @throws Exception if the columns and values do not have the same length
     */
    abstract public function insert(SerializableObject $obj): bool;

    /**
     * Insert a new row into the table with the given SerializableObject object<br>
     * Default implementation
     */
    protected function defaultInsert(SerializableObject $obj): bool
    {
        $keys = array_keys($obj->toInsertArray());
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", $keys) . ") VALUES (:" . implode(", :", array_map(fn($key) => $this->escape_and_lower($key), $keys)) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($obj->toInsertArray() as $key => $value)
            $stmt->bindValue(':' . $this->escape_and_lower($key), $value);
        return $stmt->execute();
    }

    /**
     * Insert a new row into the table with the given columns and values
     *
     * @param array $columns The columns to insert
     * @param array $values The values to insert (in the same order as the columns)
     * @return bool True if the insert was successful, false otherwise
     */
    public function insertWith(array $columns, array $values): bool
    {
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_map((fn($column) => ":" . $this->escape_and_lower($column)), $columns)) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($columns as $column)
            $stmt->bindValue(':' . $column, $values[$column]);
        return $stmt->execute();
    }

    /**
     * Insert a new row into the table with the given associative array of columns and values
     *
     * @param array $data Associative array of columns and values to insert
     * @return bool True if the insert was successful, false otherwise
     */
    public function insertWithArray(array $data): bool
    {
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", array_keys($data)) . ") VALUES (" . implode(", ", array_map((fn($column) => ":" . $this->escape_and_lower($column)), array_keys($data))) . ")";
        $stmt = $this->getDatabase()->prepare($query);
        foreach(array_keys($data) as $column)
            $stmt->bindValue(':' . $this->escape_and_lower($column), $data[$column]);
        return $stmt->execute();
    }

    /**
     * Select one or more rows from the table with the given column keys and values
     *
     * @param array $conditions Associative array of column keys and values to select
     * @return mixed The result of the select (e.g. an object or an array of objects)
     */
    abstract public function select(array $conditions): mixed;

    /**
     * Select rows from the table with the given column keys and values<br>
     * Default implementation
     *
     * @param array $conditions Associative array of column keys and values to select
     * @param callable $fromArray The object to create from the row
     */
    protected function defaultSelect(string $join_query, array $conditions, callable $fromArray): mixed
    {
        try
        {
            $query = "SELECT * FROM " . $this->getTableName() . ' ' . $join_query ?? "";
            if(empty($conditions))
            {
                $stmt = $this->getDatabase()->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return array_map((fn($row) => $fromArray($row)), $rows);
            }
            $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " = :" . $this->escape_and_lower($key)), array_keys($conditions)));
            $stmt = $this->getDatabase()->prepare($query);

            foreach($conditions as $key => $value)
                $stmt->bindValue(':' . $this->escape_and_lower($key), $value);

            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);
        }
        catch(Exception $e)
        {
        }
        return null;
    }

    /**
     * Select one or more rows from the table with the given column keys and values with an OR condition<br>
     * Default implementation<br>
     * WARNING: The values must be the column name (e.g. ["1" => "id"]) to search multiple values for the same column
     *
     * @param string $join_query The join query to use
     * @param array $conditions Associative array of column keys and values to select. WARNING: The values must be the column name
     * @param callable $fromArray The object to create from the row
     * @return mixed The result of the select (e.g. an object or an array of objects)
     */
    protected function defaultSelectOr(string $join_query, array $conditions, callable $fromArray): mixed
    {
        try
        {
            $query = "SELECT * FROM " . $this->getTableName() . ' ' . $join_query ?? "";
            if(empty($conditions))
            {
                $stmt = $this->getDatabase()->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return array_map((fn($row) => $fromArray($row)), $rows);
            }

            // We use the inverse of the conditions beacause we have ["1" => "id"] to have ["id" => "1"]
            $query .= " WHERE " . implode(" OR ", array_map((fn($key) => $conditions[$key] . " = " . $key), array_keys($conditions)));

            $stmt = $this->getDatabase()->query($query);

            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);
        }
        catch(Exception $e)
        {
        }
        return null;
    }

    public function selectLike(array $conditions, callable $fromArray): mixed
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" AND ", array_map((fn($key) => $key . " LIKE :" . $this->escape_and_lower($key)), array_keys($conditions)));

        $stmt = $this->getDatabase()->prepare($query);

        foreach($conditions as $key => $value)
            $stmt->bindValue(':' . $this->escape_and_lower($key), $value);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return $fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => $fromArray($row)), $rows);

        return null;
    }

    /**
     * Select from the table with special conditions
     *
     * @param array $conditions The conditions to apply to the select (e.g. "id = 1")
     * @return PDOStatement|null The result of the select
     * @throws Exception if the function is not implemented
     */
    public function selectSpecialConditions(array $conditions, callable $fromArray): mixed
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" AND ", $conditions);

        $stmt = $this->getDatabase()->prepare($query);

        foreach($conditions as $key => $value)
            $stmt->bindValue(':' . $this->escape_and_lower($key), $value);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return $fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => $fromArray($row)), $rows);

        return null;
    }

    /**
     * Select from the table with special conditions
     *
     * @param array $conditions The conditions to apply to the select (e.g. "id = 1")
     * @return PDOStatement|null The result of the select
     * @throws Exception if the function is not implemented
     */
    public function selectSpecialConditionsAndParameters(array $conditions, string $parameters, callable $fromArray): mixed
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $query .= " " . $parameters;
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" AND ", $conditions);

        $query .= " " . $parameters;
         $stmt = $this->getDatabase()->prepare($query);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return $fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => $fromArray($row)), $rows);

        return null;
    }

    public function selectJoinSpecialConditionsAndParameters(string $join_query, array $conditions, string $parameters, callable $fromArray): mixed
    {
        $query = "SELECT * FROM " . $this->getTableName() . " " . $join_query;

        if(empty($conditions))
        {
            $query .= " " . $parameters;
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" AND ", $conditions);

        $query .= " " . $parameters;
        $stmt = $this->getDatabase()->prepare($query);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return $fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => $fromArray($row)), $rows);

        return null;
    }

    /**
     * Select from the table with special conditions
     *
     * @param array $conditions The conditions to apply to the select (e.g. "id = 1")
     * @return PDOStatement|null The result of the select
     * @throws Exception if the function is not implemented
     */
    public function selectOrSpecialConditionsAndParameters(array $conditions, string $parameters, callable $fromArray): mixed
    {
        $query = "SELECT * FROM " . $this->getTableName();

        if(empty($conditions))
        {
            $query .= " " . $parameters;
            $stmt = $this->getDatabase()->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) == 1)
                return $fromArray($rows[0]);
            elseif(count($rows) > 1)
                return array_map((fn($row) => $fromArray($row)), $rows);

            return null;
        }

        $query .= " WHERE " . implode(" OR ", $conditions);

        $query .= " " . $parameters;

        $stmt = $this->getDatabase()->prepare($query);

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) == 1)
            return $fromArray($rows[0]);
        elseif(count($rows) > 1)
            return array_map((fn($row) => $fromArray($row)), $rows);

        return null;
    }

    public function selectColumnValues(string $columnName): array
    {
        $query = "SELECT " . $columnName . " FROM " . $this->getTableName() . " GROUP BY " . $columnName . " ORDER BY " . $columnName . " ASC";
        $stmt = $this->getDatabase()->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function selectColumnsValues(array $columns): array
    {
        $query = "SELECT " . implode(', ', $columns) . " FROM " . $this->getTableName() . " GROUP BY " . $columns[0] . " ORDER BY " . $columns[0] . " ASC";
        $stmt = $this->getDatabase()->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $values = [];

        foreach($data as $row)
            $values[] = array_map((fn($column) => $row[$column]), $columns);

        return $values;
    }

    public function selectColumnNames(): array
    {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->getTableName() . "'";
        $stmt = $this->getDatabase()->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function selectJoinedColumnNames(string... $tables): array
    {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->getTableName() . "' OR " . implode(" OR ", array_map((fn($table) => "TABLE_NAME = '" . $table . "'"), $tables));
        $stmt = $this->getDatabase()->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
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
    abstract public function update(mixed $id, array $columns, array $values): bool;

    /**
     * Update the row with the given id<br>
     * Default implementation
     */
    protected function defaultUpdate(mixed $id, array $columns, array $values): bool
    {
        $query = "UPDATE " . $this->getTableName() . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $column), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($columns as $column)
            $stmt->bindValue(':' . $column, $values[$column]);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    /**
     * Update the row with the given id<br>
     * Default implementation
     */
    public function defaultJoinUpdate(mixed $id, string $join_query, array $data): bool
    {
        $columns = array_keys($data);
        $query = "UPDATE " . $this->getTableName() . " " . $join_query . " SET " . implode(", ", array_map((fn($column) => $column . " = :" . $this->escape_and_lower($column)), $columns)) . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        foreach($data as $column => $value)
            $stmt->bindValue(':' . $this->escape_and_lower($column), $value);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    /**
     * Delete the row with the given id
     *
     * @param mixed $id The id of the row to delete
     * @return bool True if deletion was successful, false otherwise
     */
    abstract public function delete(mixed $id): bool;

    /**
     * Delete the row with the given id<br>
     * Default implementation
     */
    protected function defaultDelete(mixed $id): bool
    {
        $query = "DELETE FROM " . $this->getTableName() . " WHERE " . $this->getIdColumn() . " = :id";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }


    public function getRowCount(): int
    {
        $query = 'SELECT COUNT(*) AS rowCount FROM ' . $this->getTableName();
        $stmt = $this->getDatabase()->query($query);
        return intval($stmt->fetch()['rowCount']);
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

    protected function escape_and_lower(string $input): string
    {
        return strtolower(str_replace(".", "", $input));
    }

    public static function inner_join(string $joined_table, string $column, string $joined_column): string
    {
        return "INNER JOIN " . $joined_table . " ON " . $column . " = " . $joined_column;
    }

    public static function left_join(string $joined_table, string $column, string $joined_column): string
    {
        return "LEFT JOIN " . $joined_table . " ON " . $column . " = " . $joined_column;
    }

    public static function no_join(): string
    {
        return "";
    }

    public function getLastInsertId(): int
    {
        $query = "SELECT LAST_INSERT_ID() AS id FROM " . $this->getTableName() . " LIMIT 1";
        $stmt = $this->getDatabase()->query($query);
        return $stmt->fetch()['id'];
    }
}
