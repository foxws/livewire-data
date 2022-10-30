<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\DataObjects\DataObject;
use Foxws\Data\Exceptions\InvalidDataTransferObject;
use Foxws\Data\Support\DataTransferObject;

trait WithData
{
    public function bootWithData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data())
            ->each(fn (DataObject $object) => $this->createData($object));
    }

    public function mountWithData(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        collect($this->data())
            ->each(fn (DataObject $object) => $this->transformData($object));
    }

    protected function createData(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->name), InvalidDataTransferObject::make($object->name));

        data_set($this, $object->name, new DataTransferObject(), false);
    }

    protected function transformData(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->name), InvalidDataTransferObject::make($object->name));

        data_set($this, $object->name, $object->transform());
    }

    protected function findDataObject(string $property): ?DataObject
    {
        return collect($this->data())
            ->first(fn ($object) => $object->property === $property);
    }

    protected function refreshDataObject(string $property): void
    {
        $object = $this->findDataObject($property);

        if ($object) {
            $this->transformData($object);
        }
    }
}
