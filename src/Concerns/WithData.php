<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Data\DataObject;
use Foxws\Data\Exceptions\MissingProperty;
use Foxws\Data\Support\DataTransferObject;
use Spatie\LaravelData\Data;

trait WithData
{
    protected function setup(): void
    {
        collect($this->data())
            ->filter(fn ($object) => $object instanceof DataObject)
            ->each(fn (DataObject $object) => $this->setDataObject($object));
    }

    protected function setDataObject(DataObject $object): void
    {
        throw_if(! property_exists($this, $object->name), MissingProperty::class);

        ! $object->model
            ? data_set($this, $object->name, new DataTransferObject($this->create($object)))
            : data_set($this, $object->name, new DataTransferObject($this->transform($object)));
    }

    protected function create(DataObject $object): array
    {
        $current = data_get($this, $object->name);

        if (! $current) {
            return app($object->data)::empty();
        }

        return $current->toArray();
    }

    protected function transform(DataObject $object): array
    {
        return $this->getData($object)->toArray();
    }

    protected function getData(DataObject $object): Data
    {
        return $object->model->getData()
            ->include(...$object->includes ?? [])
            ->exclude(...$object->exclude ?? [])
            ->only(...$object->only ?? [])
            ->except(...$object->except ?? [])
            ->additional($object->additional ?? []);
    }
}
