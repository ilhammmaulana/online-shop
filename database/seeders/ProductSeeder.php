<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;
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
        $users = User::where('email', 'admin@gmail.com')->first();
        $category = CategoryProduct::where('name', 't-shirt')->first();
        $products = collect([
            [
                "name" => "T-shirt Putih",
                "description" => "T-shirt berwarna putih dengan bahan berkualitas tinggi.",
                "created_by" => $users->id,
                "price" => 150000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Celana Jeans Slim Fit",
                "description" => "Celana jeans dengan potongan slim fit yang nyaman dipakai sehari-hari.",
                "created_by" => $users->id,
                "price" => 250000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Jaket Kulit Hitam",
                "description" => "Jaket kulit berwarna hitam yang stylish dan tahan lama.",
                "created_by" => $users->id,
                "price" => 450000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Gaun Pesta Merah",
                "description" => "Gaun pesta berwarna merah dengan desain elegan.",
                "created_by" => $users->id,
                "price" => 750000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Sneakers Putih",
                "description" => "Sepatu sneakers berwarna putih yang cocok untuk gaya kasual.",
                "created_by" => $users->id,
                "price" => 300000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Kemeja Denim",
                "description" => "Kemeja denim dengan tampilan retro yang keren.",
                "created_by" => $users->id,
                "price" => 220000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Topi Trucker",
                "description" => "Topi trucker dengan logo unik di depan.",
                "created_by" => $users->id,
                "price" => 75000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Rok Mini Hitam",
                "description" => "Rok mini berwarna hitam yang stylish.",
                "created_by" => $users->id,
                "price" => 120000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Sandal Jepit",
                "description" => "Sandal jepit yang nyaman untuk santai di pantai.",
                "created_by" => $users->id,
                "price" => 80000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
            [
                "name" => "Kaos Polo",
                "description" => "Kaos polo dengan bahan katun yang lembut.",
                "created_by" => $users->id,
                "price" => 95000,
                "stock" => rand(1, 50),
                "category_id" => $category->id,
            ],
        ]);
        $products->each(function ($product) {
            Product::create($product);
        });
    }
}
