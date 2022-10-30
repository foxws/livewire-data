<?php

namespace Foxws\Data;

use Foxws\Data\DataObjects\DataObject;
use Foxws\Data\Exceptions\DuplicatedDataObjects;
use Foxws\Data\Exceptions\InvalidDataObject;

class Data
{
    /** @var array<int, DataObject> */
    protected array $data = [];

    /** @param  array<int, DataObject>  $data */
    public function dataObjects(array $data): self
    {
        $this->ensureDataObjectInstances($data);

        $this->data = array_merge($this->data, $data);

        $this->guardAgainstDuplicateDataObjectNames();

        return $this;
    }

    public function clearDataObjects(): self
    {
        $this->data = [];

        return $this;
    }

    /** @param  array<int,mixed>  $data */
    protected function ensureDataObjectInstances(array $data): void
    {
        foreach ($data as $dataObject) {
            if (! $dataObject instanceof DataObject) {
                throw InvalidDataObject::doesNotExtendData($dataObject);
            }
        }
    }

    protected function guardAgainstDuplicateDataObjectNames(): void
    {
        $duplicateDataObjectNames = collect($this->data)
            ->map(fn (DataObject $dataObject) => $dataObject->getName())
            ->duplicates();

        if ($duplicateDataObjectNames->isNotEmpty()) {
            throw DuplicatedDataObjects::make($duplicateDataObjectNames);
        }
    }
}
