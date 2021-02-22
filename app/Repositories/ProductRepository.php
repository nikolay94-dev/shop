<?php


namespace App\Repositories;


use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{
    public function getMinPriceProduct($products):Product
    {
        return $products
            ->where('price', $products->min('price'))
            ->first();
    }

    public function getMaxPriceProduct($products):Product
    {
        return $products
            ->where('price', $products->max('price'))
            ->first();
    }

    public function updateProduct(Product $product, Request $request)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $this->createCategoryProduct($product, $request);
    }

    private function createCategoryProduct(Product $product, Request $request)
    {
        if ($product->categories) {
            $product->categories()->detach();
            $product->categories()->delete();
        }

        foreach ($request->all()['category'] as $category) {
            $categoryProduct = new CategoryProduct();
            $categoryProduct->category_id = $category;
            $categoryProduct->product_id = $product->id;
            $categoryProduct->save();
        }
    }
}
