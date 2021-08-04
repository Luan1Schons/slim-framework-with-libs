<?php

namespace SlimMonsterKit\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class FieldEmpty extends AbstractRule
{
    protected $fields;

    public function __construct($field)
    {
        $this->fields = [];
        if (is_string($field)) {
            array_push($this->fields, $field);
        }

        if (is_array($field)) {
            $this->fields = $field;
        }
    }

    public function validate($input)
    {
        return $input != "" || array_filter($this->fields, function ($field) {
            return !empty($field);
        });
    }
}
