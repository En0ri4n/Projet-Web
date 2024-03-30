<?php

namespace model\object;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/SerializableInterface.php');

/**
 * Abstract class that implements the SerializableInterface interface and the JsonSerializable interface
 */
abstract class SerializableObject implements SerializableInterface, \JsonSerializable
{
    /**
     * Used by the json_encode function to serialize the object
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Extract the column name from the table name (e.g. 'Offre.id' -> 'id')
     *
     * @param string $name The full name of the column (e.g. 'Offre.id')
     * @return string The name of the column
     */
    protected static function getColumnName(string $name): string
    {
        return explode('.', $name)[1];
    }
}