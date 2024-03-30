<?php

namespace model\object;

use model\table\LinkTable;

class Link extends SerializableObject
{
    private int $id_from;
    private int $id_to;

    public function __construct(int $id_from, int $id_to)
    {
        $this->id_from = $id_from;
        $this->id_to = $id_to;
    }

    public function getIdFrom(): int
    {
        return $this->id_from;
    }

    public function getIdTo(): int
    {
        return $this->id_to;
    }

    public function linkToArray(LinkTable $table): array
    {
        return [
            $table->getIdFromColumn() => $this->id_from,
            $table->getIdToColumn() => $this->id_to
        ];
    }

    public static function linkFromArray(LinkTable $table, array $array): Link
    {
        return new Link($array[$table->getIdFromColumn()], $array[$table->getIdToColumn()]);
    }

    public function toArray(): array
    {
        return array();
    }

    public static function fromArray(array $array): mixed
    {
        return null;
    }
}