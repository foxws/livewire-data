<?php

namespace Foxws\Data;

use Foxws\Data\Concerns\WithData;
use Livewire\Component;

abstract class Data extends Component
{
    use WithData;

    public function booted(): void
    {
        $this->setup();
    }

    abstract protected function data(): array;
}
