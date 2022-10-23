<?php

namespace Foxws\Data;

use Foxws\Data\Support\DataObject;

class Data
{
    /** @var DataObject[] */
    public array $objects;

    public function __construct()
    {
        $this->objects = [];
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function add(string $property, callable $data): self
    {
        $object = new DataObject($property, $data);

        $this->objects[] = $object;

        return $this;
    }
}
