<?php

namespace Foxws\Data\Concerns;

use Foxws\Data\Data\DataObject;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use stdClass;

trait WithData
{
    protected Collection $data;

    public function bootWithData(): void
    {
        $this->data = collect();
    }

    protected function setup(): void
    {
        $this->data = collect($this->data())
            ->filter(fn ($object) => $object instanceof DataObject)
            ->map(fn (DataObject $object) => $this->transform($object->data));
    }

    protected function transform(Data $data): stdClass
    {
        return json_decode($data->toJson(), false);
    }
}
