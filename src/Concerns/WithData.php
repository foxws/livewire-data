<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Data\DataObject;
use Foxws\Data\Exceptions\MissingData;
use Foxws\Data\Exceptions\MissingProperty;
use Foxws\Data\Support\DataTransferObject;
use Illuminate\Database\Eloquent\Model;
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

        $object->model instanceof Model
            ? data_set($this, $object->name, $this->transform($object), true)
            : data_set($this, $object->name, $this->create($object), false);
    }

    protected function create(DataObject $object): DataTransferObject
    {
        throw_if(! $object->data, MissingData::class);

        return new DataTransferObject(
            call_user_func([$object->data, 'empty'])
        );
    }

    protected function transform(DataObject $object): DataTransferObject
    {
        return new DataTransferObject(
            $this->getData($object)->toArray()
        );
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
