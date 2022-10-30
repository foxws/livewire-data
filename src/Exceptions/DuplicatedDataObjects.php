<?php

namespace Foxws\Data\Exceptions;

use Exception;
use Illuminate\Support\Collection;

class DuplicatedDataObjects extends Exception
{
    public static function make(Collection $duplicateDataObjectNames): self
    {
        $duplicateDataObjectNamesString = $duplicateDataObjectNames
            ->map(fn (string $name) => "`{$name}`")
            ->join(', ', ' and ');

        return new self("You registered data objects with a non-unique name: {$duplicateDataObjectNamesString}. Each data object should be unique. If you really want to use the same data object class twice, make sure to call `name()` on them to ensure that they all have unique names.");
    }
}
