<?php

namespace Foxws\Data\Support;

use Closure;

class DataObject
{
    public string $property;

    public Closure $data;

    public function __construct(string $property = '', ?callable $data = null)
    {
        $this->property = $property;
        $this->data = $data;
    }
}
