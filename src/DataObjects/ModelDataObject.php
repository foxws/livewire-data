<?php

namespace Foxws\Data\DataObjects;

use Closure;
use Foxws\Data\Support\DataTransferObject;
use Illuminate\Database\Eloquent\Model;

class ModelDataObject extends DataObject
{
    protected ?Model $model = null;

    protected ?Closure $callback = null;

    public function model(string $model, callable $callback = null): self
    {
        $this->model = $model;

        $this->callback = $callback;

        return $this;
    }

    public function transform(): DataTransferObject
    {
        return new DataTransferObject(
            $this->callback instanceof Closure
                ? $this->model->getData()($this->callback)
                : $this->model->getData()
        );
    }
}
