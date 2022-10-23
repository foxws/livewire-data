<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Support\DataObject;
use Foxws\Data\Support\DataTransferObject;
use Spatie\LaravelData\Data;

trait WithData
{
    public function bootWithData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data()?->objects)
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->createData($object));
    }

    public function mountWithData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data()?->objects)
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->setData($object));
    }

    protected function createData(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->property));

        data_set($this, $object->property, new DataTransferObject(), false);
    }

    protected function setData(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->property));

        $dto = call_user_func($object->data);

        $dto instanceof Data
            ? data_set($this, $object->property, new DataTransferObject($dto->toArray()))
            : data_set($this, $object->property, new DataTransferObject($dto));
    }
}
