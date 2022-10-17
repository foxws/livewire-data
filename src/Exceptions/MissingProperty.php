<?php

namespace Foxws\Data\Exceptions;

use Exception;
use Foxws\Data\Contracts\DataObject;

class MissingProperty extends Exception
{
    public static function make(DataObject $object): self
    {
        return new self("The property for `{$object->name}` has not been set.");
    }
}
