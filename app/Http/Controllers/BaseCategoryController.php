<?php

namespace App\Http\Controllers;

use App\Helpers\ParseMessage;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Validators\CategoryValidator;
use Illuminate\Http\Request;


abstract class BaseCategoryController extends Controller
{
    private $categoryRepository;
    private $productRepository;
    private $categoryValidator;
    private $parseMessage;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        CategoryValidator $categoryValidator
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->categoryValidator = $categoryValidator;
        $this->parseMessage = (new ParseMessage());
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return $this->fillCategoriesData();
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
        $validator = $this->categoryValidator->make($request->all());
        $data['error'] = $this->parseMessage->parseValidationErrorMessage(
            $this->categoryValidator->getErrorMessage($validator)
        );
        if (!$data['error']) {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            $data['category'] = $category;
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id, $error = null)
    {
        return [
            'error_message' => $error,
            'category' => Category::findOrFail($id)
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
        $validator = $this->categoryValidator->make($request->all());
        $data['error'] = $this->parseMessage->parseValidationErrorMessage(
            $this->categoryValidator->getErrorMessage($validator)
        );
        $category = Category::findOrFail($id);
        if (!$data['error']) {
            $category->name = $request->name;
            $category->save();
        }
        $data['category'] = $category;
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $data['error'] = $this->categoryValidator->deleteAccess($category);
        if (!$data['error']) {
            $category->delete();
        }
        return $data['error'];
    }

    private function fillCategoriesData()
    {
        $data = [];
        foreach ($this->categoryRepository->getCategoriesWithProductsCount()->get() as $key => $category) {
            $products = $category->products;
            $data += [
                $key => [
                    'category_name' => $category->name,
                    'category_id' => $category->id,
                    'product_count' => $category->products_count,
                    'min_price_product' =>
                        count($products) ? $this->productRepository->getMinPriceProduct($products)->price : null,
                    'max_price_product' =>
                        count($products) ? $this->productRepository->getMaxPriceProduct($products)->price : null
                ]
            ];
        }
        return $data;
    }
}
