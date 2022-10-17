<?php

namespace Foxws\Data\Contracts;

use Illuminate\Database\Eloquent\Model;

interface DataObject
{
    public function name(string $name): self;

    public function model(Model $model): self;
}
