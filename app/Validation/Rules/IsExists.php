<?php

namespace SlimMonsterKit\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class IsExists extends AbstractRule
{
    protected $model;
    protected $nullable;

    public function __construct($model, $nullable = false)
    {
        $this->model = $model;
        $this->nullable = $nullable;
    }

    public function validate($input)
    {
        if (!$input && $this->nullable) {
            return true;
        }
        return $this->model->find($input);
    }
}
