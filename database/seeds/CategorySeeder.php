<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Категория 1']);
        DB::table('categories')->insert(['name' => 'Категория 2']);
        DB::table('categories')->insert(['name' => 'Категория 3']);
    }
}
