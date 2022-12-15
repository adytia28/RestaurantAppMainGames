<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Food', 'Drink'];

        foreach($categories as $item) {
            $category = new Category;
            $category->name = $item;
            $category->slug = Str::slug($item);
            $category->save();
        }
    }
}
