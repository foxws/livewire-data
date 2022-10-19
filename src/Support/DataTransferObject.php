<?php

namespace Foxws\Data\Support;

use Livewire\Wireable;

class DataTransferObject implements Wireable
{
    protected array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }

    public function __get($name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    public function toLivewire(): array
    {
        return $this->data;
    }

    public static function fromLivewire($value): self
    {
        return new self($value);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
