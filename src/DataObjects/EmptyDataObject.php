<?php

namespace Foxws\Data\DataObjects;

use Foxws\Data\Support\DataTransferObject;
use Spatie\LaravelData\Data;

class EmptyDataObject extends DataObject
{
    protected ?Data $data = null;

    protected ?array $extra = null;

    public function data(string $data, array $extra = null): self
    {
        $this->data = $data;

        $this->extra = $extra;

        return $this;
    }

    public function transform(): DataTransferObject
    {
        return new DataTransferObject(
            $this->data->empty($this->extra)
        );
    }
}
