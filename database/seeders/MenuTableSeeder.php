<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuVariant;
use App\Models\MenuVariantDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $menus = [
            [
                "name"          => "Nasi Goreng Spicy Chicken",
                "categories"    => 1,
                "price"         => 50000,
                "variants"      => [
                    [
                        "name"  => "Sosis Topping",
                        "stock" => 200,
                        "price" => 10000
                    ], [
                        "name"  => "Nugget Topping",
                        "stock" => 250,
                        "price" => 15000
                    ], [
                        "name"  => "Bakso Topping",
                        "stock" => 300,
                        "price" => 10000
                    ],
                ]
            ], [
                "name"          => "Capcay Korean Spicy",
                "categories"    => 1,
                "price"         => 50000,
                "variants"      => [
                    [
                        "name"  => "Sosis Topping",
                        "stock" => 200,
                        "price" => 10000
                    ], [
                        "name"  => "Nugget Topping",
                        "stock" => 250,
                        "price" => 15000
                    ], [
                        "name"  => "Bakso Topping",
                        "stock" => 300,
                        "price" => 10000
                    ],
                ]
            ], [
                "name"          => "Pepsi",
                "categories"    => 2,
                "price"         => 20000,
                "variants"      => [
                    [
                        "name"  => "Normal Ice",
                        "stock" => 200,
                        "price" => 5000
                    ], [
                        "name"  => "Less Ice",
                        "stock" => 400,
                        "price" => 0
                    ]
                ]
            ], [
                "name"          => "Coffee Milk Tea Ice",
                "categories"    => 2,
                "price"         => 40000,
                "variants"      => [
                    [
                        "name"  => "Aren Sugar",
                        "stock" => 150,
                        "price" => 8000
                    ], [
                        "name"  => "Normal Sugar",
                        "stock" => 300,
                        "price" => 4000
                    ], [
                        "name"  => "Less Sugar",
                        "stock" => 300,
                        "price" => 0
                    ],
                ]
            ]
        ];


        foreach($menus as $key => $item) {
            $menu = new Menu;
            $menu->categories_id = $item['categories'];
            $menu->name = $item['name'];
            $menu->price = $item['price'];
            $menu->save();

            foreach($item['variants'] as $listVariant) {
                $menuVariant = new MenuVariant;
                $menuVariant->menus_id = $menu->id;
                $menuVariant->name = $listVariant['name'];
                $menuVariant->save();

                $menuVariantDetail = new MenuVariantDetail;
                $menuVariantDetail->menu_variants_id = $menuVariant->id;
                $menuVariantDetail->stock = $listVariant['stock'];
                $menuVariantDetail->price = $listVariant['price'];
                $menuVariantDetail->save();

            }
        }
    }
}
