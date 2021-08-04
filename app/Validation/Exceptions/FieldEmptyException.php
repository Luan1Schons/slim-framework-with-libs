<?php

namespace SlimMonsterKit\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class FieldEmptyException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Preencha o campo {{name}}!',
        ]
    ];
}
