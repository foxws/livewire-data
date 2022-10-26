<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Support\DataObject;
use Foxws\Data\Support\DataTransferObject;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

trait WithData
{
    protected Collection $data;

    public function bootWithData(): void
    {
        $this->data = collect();

        $this->createDataObjects();
    }

    public function mountWithData(): void
    {
        $this->setDataObjects();
    }

    protected function createDataObjects(): void
    {
        if (! method_exists($this, 'data')) {
            return;
        }

        $this->data = collect($this->data()->objects)
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->createDataObject($object));
    }

    protected function setDataObjects(): void
    {
        $this->data->each(
            fn (DataObject $object) => $this->setDataObject($object)
        );
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

    protected function findDataObject(string $property): ?DataObject
    {
        return $this->data->first(
            fn ($object) => $object->property === $property
        );
    }

    protected function refreshDataObject(string $property): void
    {
        $object = $this->findDataObject($property);

        if ($object) {
            $this->setDataObject($object);
        }
    }
}
