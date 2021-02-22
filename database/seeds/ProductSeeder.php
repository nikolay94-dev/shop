<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Процессор Intel Core i9-10940X OEM',
            'price' => 100
        ]);
        DB::table('products')->insert([
            'name' => 'Процессор AMD Ryzen 9 3900XT OEM',
            'price' => 200
        ]);
        DB::table('products')->insert([
            'name' => 'Процессор Intel Core i7-10700K Marvels Avengers Collectors Edition BOX',
            'price' => 100
        ]);
        DB::table('products')->insert([
            'name' => 'Процессор Intel Core i5-10600 BOX',
            'price' => 200
        ]);
        DB::table('products')->insert([
            'name' => 'Процессор AMD Ryzen 5 3600XT OEM',
            'price' => 200
        ]);

        DB::table('products')->insert([
            'name' => 'Процессор AMD Ryzen 7 3800XT OEM',
            'price' => 300
        ]);
        DB::table('category_product')->insert([
            'product_id' => 1,
            'category_id' => 2
        ]);
        DB::table('category_product')->insert([
            'product_id' => 2,
            'category_id' => 2
        ]);
        DB::table('category_product')->insert([
            'product_id' => 3,
            'category_id' => 1
        ]);
        DB::table('category_product')->insert([
            'product_id' => 4,
            'category_id' => 2
        ]);
        DB::table('category_product')->insert([
            'product_id' => 4,
            'category_id' => 3
        ]);
        DB::table('category_product')->insert([
            'product_id' => 5,
            'category_id' => 1
        ]);
        DB::table('category_product')->insert([
            'product_id' => 5,
            'category_id' => 3
        ]);
        DB::table('category_product')->insert([
            'product_id' => 6,
            'category_id' => 1
        ]);
        DB::table('category_product')->insert([
            'product_id' => 6,
            'category_id' => 2
        ]);
    }
}
