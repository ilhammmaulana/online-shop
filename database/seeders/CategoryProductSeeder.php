<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = collect([
            [
                "name" => "shoes"
            ],
            [
                "name" => "t-shirt"
            ],
            [
                "name" => "jeans"
            ],
            [
                "name" => "dresses"
            ],
            [
                "name" => "accessories"
            ],
            [
                "name" => "hats"
            ],
            [
                "name" => "sunglasses"
            ],
            [
                "name" => "scarves"
            ],
            [
                "name" => "watches"
            ],
            [
                "name" => "belts"
            ],
            [
                "name" => "handbags"
            ],
            [
                "name" => "socks"
            ],
            [
                "name" => "jackets"
            ],
            [
                "name" => "skirts"
            ],
            [
                "name" => "sweaters"
            ],
            [
                "name" => "swimwear"
            ],
            [
                "name" => "gloves"
            ],
            [
                "name" => "hoodies"
            ],
            [
                "name" => "pants"
            ],
            [
                "name" => "tops"
            ],
            [
                "name" => "coats"
            ],
            [
                "name" => "boots"
            ],
            [
                "name" => "sneakers"
            ],
            [
                "name" => "sandals"
            ],
            [
                "name" => "jewelry"
            ],
            [
                "name" => "suits"
            ],
            [
                "name" => "ties"
            ],
            [
                "name" => "backpacks"
            ],
            [
                "name" => "umbrellas"
            ],
            [
                "name" => "luggage"
            ],
        ]);
        $data->each(function ($category) {
            CategoryProduct::create($category);
        });
    }
}
