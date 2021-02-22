<?php


namespace App\Validators;

class CategoryValidator extends BaseBalidator
{
    protected $methodRelated = 'products';

    public function deleteAccess($entity)
    {
        return
            count($entity->{$this->methodRelated}) ? $this->deleteErrorMessage() : null;
    }

    protected function rules():array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    protected function deleteErrorMessage()
    {
        return 'Нельзя удалить категорию, в которой есть товары';
    }
}
