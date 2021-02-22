<?php


namespace App\Validators;

use Illuminate\Support\Facades\Validator;

abstract class BaseBalidator extends Validator
{
    protected $methodRelated;

    abstract protected function rules(): array;

    public function make($data)
    {
        return parent::make($data, $this->rules());
    }

    public function getErrorMessage($validator)
    {
        return $validator->fails() ? $validator->getMessageBag()->getMessages() : null;
    }

}
