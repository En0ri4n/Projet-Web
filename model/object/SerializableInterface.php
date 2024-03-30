<?php

namespace model\object;

interface SerializableInterface extends \JsonSerializable
{
    public function toArray(): array;

    public static function fromArray(array $array): mixed;
}