<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseProductController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends BaseProductController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('product.index', [
            'products' => parent::index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request, $error = null)
    {
        $categoriesAll = Category::all();
        return view('product.create', [
            'error_message' => $error,
            'categoriesAll' => $categoriesAll
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $categoriesAll = Category::all();
        $data = parent::store($request);
        return view('product.create', [
            'error_message' => $data['error'],
            'categoriesAll' => $categoriesAll
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id, $error = null)
    {
        $data = parent::show($id);
        return view('product.edit', [
            'error_message' => $error,
            'product' => $data['product'],
            'categories' => $data['categories'],
            'categoriesAll' => Category::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id, $error = null)
    {
        $categories = Category::all();
        $data = parent::edit($id);
        return view('product.edit', [
            'error_message' => $data['error_message'],
            'product' => $data['product'],
            'categories' => $data['categories'],
            'categoriesAll' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id, $error = null)
    {
        $data = parent::update($request, $id);
        if(!$data['error'])
            return redirect('/product/'.$id);

        return view('product.edit', [
            'error_message' => $data['error'],
            'product' => $data['product'],
            'categories' => $data['categories'],
            'categoriesAll' => Category::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        parent::destroy($id);
        return redirect('/product');
    }
}
