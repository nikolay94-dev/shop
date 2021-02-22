<?php


namespace App\Validators;


class ProductValidator extends BaseBalidator
{
    protected $methodRelated = 'categories';

    public function createAccess($requestData)
    {
        if (isset($requestData['category'])) {
            if (!empty($requestData['category'])) {
                return null;
            }
        }

        return $this->getCreateAccessMessage();
    }

    protected function rules():array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
        ];
    }

    private function getCreateAccessMessage()
    {
        return 'Нельзя создать товар без категории';
    }
}
