<?php

namespace Foxws\Data\Support;

use Illuminate\Support\Fluent;
use Livewire\Wireable;

class DataTransferObject extends Fluent implements Wireable
{
    public function toLivewire(): array
    {
        return $this->toArray();
    }

    public static function fromLivewire($value): static
    {
        return new self($value);
    }
}
