<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Support\DataObject;
use Foxws\Data\Support\DataTransferObject;
use Spatie\LaravelData\Data;

trait WithData
{
    public function bootWithData(): void
    {
        $this->createData();
    }

    public function mountWithData(): void
    {
        $this->setData();
    }

    protected function createData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data()?->objects)
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->createDataObject($object));
    }

    protected function setData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data()?->objects)
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->setDataObject($object));
    }

    protected function createDataObject(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->property));

        data_set($this, $object->property, new DataTransferObject(), false);
    }

    protected function setDataObject(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->property));

        $dto = call_user_func($object->data);

        $dto instanceof Data
            ? data_set($this, $object->property, new DataTransferObject($dto->toArray()))
            : data_set($this, $object->property, new DataTransferObject($dto));
    }
}
