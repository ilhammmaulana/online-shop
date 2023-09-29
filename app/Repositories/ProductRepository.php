<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return $products;
    }
    public function create($created_by, $data)
    {
        try {
            $data['created_by'] = $created_by;
            return Product::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getPopularProducts()
    {
        $product = Product::with('category')
            ->selectRaw('products.*, AVG(reviews.rating) as average_rating')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id')
            ->orderByRaw('average_rating DESC')
            ->get();
        return $product;
    }
}
