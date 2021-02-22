<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('category', 'Web\CategoryController', [
        'names' => [
            'index' => 'category.index',
            'edit' => 'category.edit',
            'create' => 'category.create',
            'update' => 'category.update',
            'destroy' => 'category.delete',
        ]
]);
Route::resource('product', 'Web\ProductController', [
    'names' => [
        'index' => 'product.index',
        'edit' => 'product.edit',
        'create' => 'product.create',
        'update' => 'product.update',
        'destroy' => 'product.delete',
    ]
]);

Route::get('main', 'Web\MainController@index')->name('main');

