<?php

namespace model\object;

interface SerializableInterface
{
    public function toArray(): array;

    public function toInsertArray();

    public static function fromArray(array $array): mixed;
}