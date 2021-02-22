<?php

namespace App\Http\Controllers;

use App\Helpers\ParseMessage;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Illuminate\Http\Request;


abstract class BaseProductController extends Controller
{

    private $categoryRepository;
    private $productRepository;
    private $productValidator;
    private $parseMessage;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductValidator $productValidator
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productValidator = $productValidator;
        $this->parseMessage = (new ParseMessage());
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return $this->fillProductData();
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request, $error = null)
    {
        return $this->store($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     */
    public function store(Request $request)
    {
        $validator = $this->productValidator->make($request->all());

        $data['error'] = $this->parseMessage->parseValidationErrorMessage(
            $this->productValidator->getErrorMessage($validator)
        );
        $data['error'] = $data['error'] ?? $this->productValidator->createAccess($request->all());
        if (!$data['error']) {
            $product = new Product();
            $this->productRepository->updateProduct($product, $request);
            $data['product'] = $product;
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id, $error = null)
    {
        $product = Product::findOrFail($id);
        $categories = $this->categoryRepository->getCategoriesField($product->categories, 'id');
        return [
            'error_message' => $error,
            'product' => $product,
            'categories' => $categories
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id, $error = null)
    {
        $product = Product::findOrFail($id);
        //$categories = $this->categoryRepository->getCategoriesField($product->categories, 'id');
        $categories = $this->categoryRepository->getCategoriesField($product->categories, 'id');

        return [
            'error_message' => $error,
            'product' => $product,
            'categories' => $categories
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validator = $this->productValidator->make($request->all());
        $data['error'] = $this->parseMessage->parseValidationErrorMessage(
            $this->productValidator->getErrorMessage($validator)
        );
        $data['error'] = $data['error'] ?? $this->productValidator->createAccess($request->all());
        $product = Product::findOrFail($id);
        if (!$data['error']) {
            $this->productRepository->updateProduct($product, $request);
        }
        $data['product'] = $product;
        $data['categories'] = $this->categoryRepository->getCategoriesField($product->categories, 'id');
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    private function fillProductData()
    {
        $data = [];
        foreach (Product::with('categories')->get() as $key => $product) {
            $categories = $product->categories;
            $data += [
                $key => [
                    'product_name' => $product->name,
                    'product_id' => $product->id,
                    'product_price' => $product->price,
                    'categories' => $this->fillCategoriesNames($categories),
                ]
            ];
        }
        return $data;
    }

    private function fillCategoriesNames($categories)
    {
        $categoryNames = '';

        foreach ($categories as $key => $category) {
            if ($key == 0) {
                $categoryNames .= $category->name;
                continue;
            }
            $categoryNames .= ', ' . $category->name;
        }

        return $categoryNames;
    }
}
