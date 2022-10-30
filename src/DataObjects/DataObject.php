<?php

namespace Foxws\Data\DataObjects;

use Foxws\Data\Support\DataTransferObject;
use Illuminate\Support\Str;

abstract class DataObject
{
    protected ?string $name = null;

    protected ?string $label = null;

    final public function __construct()
    {
    }

    public static function new(): static
    {
        $instance = new static();

        return $instance;
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        if ($this->label) {
            return $this->label;
        }

        $name = $this->getName();

        return Str::of($name)->snake()->replace('_', ' ')->title();
    }

    public function getName(): string
    {
        if ($this->name) {
            return $this->name;
        }

        $baseName = class_basename(static::class);

        return Str::of($baseName)->beforeLast('Data');
    }

    abstract public function transform(): DataTransferObject;
}
