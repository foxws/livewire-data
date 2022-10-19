<?php

namespace Foxws\Data\Data;

use Foxws\Data\Contracts\DataObject as DataObjectContract;
use Foxws\Data\Support\Attributable;
use Illuminate\Database\Eloquent\Model;

class DataObject extends Attributable implements DataObjectContract
{
    protected array $attributes = [];

    /** @var callable|null */
    protected $callableAttributes;

    public function name(string $name): self
    {
        $this->attributes(['name' => $name]);

        return $this;
    }

    public function data(string $data): self
    {
        $this->attributes(['data' => $data]);

        return $this;
    }

    public function model(Model $model): self
    {
        $this->attributes(['model' => $model]);

        return $this;
    }

    public function only(string ...$only): self
    {
        $this->attributes(['only' => $only]);

        return $this;
    }

    public function except(string ...$except): self
    {
        $this->attributes(['except' => $except]);

        return $this;
    }

    public function includes(string ...$includes): self
    {
        $this->attributes(['includes' => $includes]);

        return $this;
    }

    public function excludes(string ...$excludes): self
    {
        $this->attributes(['excludes' => $excludes]);

        return $this;
    }

    public function additional(array $additional): self
    {
        $this->attributes(['additional' => $additional]);

        return $this;
    }

    public function toArray(): array
    {
        return [
            $this->attributes,
        ];
    }
}
