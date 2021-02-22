<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseCategoryController;
use Illuminate\Http\Request;

class CategoryController extends BaseCategoryController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('category.index', [
            'categories' => parent::index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request, $error = null)
    {
        return view('category.create', [
            'error_message' => $error
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     */
    public function store(Request $request)
    {
        $data = parent::store($request);
        return view('category.create', [
            'error_message' => $data['error']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $category = parent::show($id);
        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id, $error = null)
    {
        $data = parent::edit($id);
        return view('category.edit', [
            'error_message' => $data['error_message'],
            'category' => $data['category']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $data = parent::update($request, $id);
        return view('category.edit', [
            'error_message' => $data['error'],
            'category' => $data['category']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $error_message = parent::destroy($id);
        return redirect('/category')
            ->with('error', $error_message);
    }
}
