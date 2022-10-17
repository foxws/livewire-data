<?php

namespace Foxws\Data\Data;

use Foxws\Data\Support\Attributable;
use Spatie\LaravelData\Data;

class DataObject extends Attributable
{
    protected array $attributes = [];

    /** @var callable|null */
    protected $callableAttributes;

    public function data(Data $data): self
    {
        $this->attributes(['data' => $data]);

        return $this;
    }

    public function toArray(): array
    {
        return [
            $this->attributes,
        ];
    }
}
