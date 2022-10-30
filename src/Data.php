<?php

namespace Foxws\Data;

use Foxws\Data\Exceptions\InvalidData;
use Foxws\Data\Support\DataObject;
use Illuminate\Support\Collection;

class Data
{
    /** @var array<int, DataObject> */
    protected array $data = [];

    /** @param  array<int, DataObject>  $data */
    public function data(array $data): self
    {
        $this->ensureCheckInstances($data);

        $this->data = array_merge($this->data, $data);

        $this->guardAgainstDuplicateCheckNames();

        return $this;
    }

    public function clearObjects(): self
    {
        $this->data = [];

        return $this;
    }

    /** @return Collection<int, DataObject> */
    public function registeredObjects(): Collection
    {
        return collect($this->data);
    }

    /** @param  array<int,mixed>  $data */
    protected function ensureCheckInstances(array $data): void
    {
        foreach ($data as $dataObject) {
            if (! $dataObject instanceof Check) {
                throw InvalidData::doesNotExtendData($dataObject);
            }
        }
    }

    protected function guardAgainstDuplicateCheckNames(): void
    {
        $duplicateCheckNames = collect($this->data)
            ->map(fn (Check $check) => $check->getName())
            ->duplicates();

        if ($duplicateCheckNames->isNotEmpty()) {
            throw DuplicateCheckNamesFound::make($duplicateCheckNames);
        }
    }
}
