<?php

namespace SlimMonsterKit\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class FieldAvailable extends AbstractRule
{
    protected $model;
    protected $field;
    protected $primaryKeyValue;
    protected $primaryKeyField;

    public function __construct($model, $field, $primaryKeyValue = null, $primaryKeyField = 'id')
    {
        $this->model = $model;
        $this->field = $field;
        $this->primaryKeyValue = $primaryKeyValue;
        $this->primaryKeyField = $primaryKeyField;
    }

    public function validate($input)
    {
        if (!$this->primaryKeyValue) {
            return $this->model->where($this->field, $input)->count() === 0;
        }

        return $this->model->where([
            [$this->field, $input],
            [$this->primaryKeyField, '!=', $this->primaryKeyValue]
        ])->count() === 0;
    }
}
