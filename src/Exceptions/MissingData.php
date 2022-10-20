<?php

namespace Foxws\Data\Exceptions;

use Exception;
use Foxws\Data\Contracts\DataObject;

class MissingData extends Exception
{
    public static function make(DataObject $object): self
    {
        return new self("The data method for `{$object->name}` has not been set.");
    }
}
