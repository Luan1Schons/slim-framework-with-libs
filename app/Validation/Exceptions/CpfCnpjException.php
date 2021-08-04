<?php

namespace SlimMonsterKit\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class CpfCnpjException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} Inválido!',
        ]
    ];
}
