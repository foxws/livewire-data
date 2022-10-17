<?php

namespace Foxws\Data;

use Foxws\Data\Concerns\WithData;
use Livewire\Component;

abstract class Data extends Component
{
    use WithData;

    abstract protected function data(): array;
}
