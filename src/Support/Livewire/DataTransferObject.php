<?php

namespace Foxws\Data\Support\Livewire;

use Livewire\Wireable;
use Spatie\LaravelData\Data;

class DataTransferObject implements Wireable
{
    public $data = [];

    public function __construct(array|Data $data)
    {
        $this->data = $data;
    }

    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }

    public function __get($name): mixed
    {
        return $this->data[$name];
    }

    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    public function toLivewire()
    {
        return $this->data;
    }

    public static function fromLivewire($value): self
    {
        return new self($value);
    }
}
