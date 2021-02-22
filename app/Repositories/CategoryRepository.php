<?php


namespace App\Repositories;


use App\Models\Category;
use App\Models\Product;

class CategoryRepository
{
    public function getCategoriesWithProductsCount()
    {
        return Category::withCount('products');
    }

    public function getCategoriesField($categories, $field)
    {
        $data = [];

        foreach ($categories as $key => $category) {
            $data += [
                $category->{$field} => $category->{$field}
           ];
        }

        return $data;
    }
}
