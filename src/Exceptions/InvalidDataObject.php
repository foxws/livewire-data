<?php

namespace Foxws\Data\Exceptions;

use Exception;

class InvalidDataObject extends Exception
{
    public static function doesNotExtendData(mixed $invalidValue): self
    {
        $dataClass = Data::class;

        $extraMessage = '';

        if (is_string($invalidValue)) {
            $extraMessage = " You tried to register a string `{$invalidValue}`";
        }

        if (is_object($invalidValue)) {
            $invalidClass = $invalidValue::class;

            $extraMessage = " You tried to register class `{$invalidClass}`";
        }

        return new self("You tried to register an invalid data. A valid data object should extend `$dataClass`.{$extraMessage}");
    }
}
