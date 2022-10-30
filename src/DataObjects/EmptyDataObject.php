<?php

namespace Foxws\Data\DataObjects;

use Foxws\Data\Support\DataTransferObject;
use Spatie\LaravelData\Data;

class EmptyDataObject extends DataObject
{
    protected ?Data $data = null;

    public function data(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function transform(): DataTransferObject
    {
        return new DataTransferObject(
            $this->data->empty()
        );
    }
}
