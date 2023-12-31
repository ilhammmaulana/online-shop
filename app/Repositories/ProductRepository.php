<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getAll()
    {
        $products = Product::select([
            'products.id',
            'products.name', // Replace with the actual column names from the 'products' table
            'products.created_by',
            'products.description',
            'products.price',
            'products.stock',
            'products.category_id',
            'products.image',
            'products.created_at',
            'products.updated_at',
            DB::raw('ROUND(AVG(reviews.rating), 2) as average_rating'),
        ])
            ->with('category')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.created_by', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderBy('products.created_at', 'DESC')
            ->paginate(10);
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
        $products = Product::select([
            'products.id',
            'products.name', // Replace with the actual column names from the 'products' table
            'products.created_by',
            'products.description',
            'products.price',
            'products.stock',
            'products.category_id',
            'products.image',
            'products.created_at',
            'products.updated_at',
            DB::raw('ROUND(AVG(reviews.rating), 2) as average_rating'),
        ])
            ->with('category')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->whereNull('products.deleted_at')
            ->groupBy('products.id', 'products.name', 'products.created_by', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderByRaw('average_rating DESC')
            ->get();
        return $products;
    }
    public function getOne($id)
    {
        $product = Product::select([
            'products.id',
            'products.name', // Replace with the actual column names from the 'products' table
            'products.created_by',
            'products.description',
            'products.price',
            'products.stock',
            'products.category_id',
            'products.image',
            'products.created_at',
            'products.updated_at',
            DB::raw('ROUND(AVG(reviews.rating), 2) as average_rating'),
        ])
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.id', $id)
            ->groupBy('products.id', 'products.name', 'products.created_by', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->firstOrFail();
        return $product;
    }
    public function searchProduct($q)
    {
        $products = Product::select([
            'products.id',
            'products.name',
            'products.created_by',
            'products.description',
            'products.price',
            'products.stock',
            'products.category_id',
            'products.image',
            'products.created_at',
            'products.updated_at',
            DB::raw('ROUND(AVG(reviews.rating), 2) as average_rating'),
        ])
            ->with('category')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.created_by', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderByRaw('average_rating DESC')
            ->where('name', 'like', '%' . $q . '%')
            ->get();

        return $products;
    }
    public function getByCategoryId($category_id)
    {
        $products = Product::select([
            'products.id',
            'products.name',
            'products.created_by',
            'products.description',
            'products.price',
            'products.stock',
            'products.category_id',
            'products.image',
            'products.created_at',
            'products.updated_at',
            DB::raw('ROUND(AVG(reviews.rating), 2) as average_rating'),
        ])
            ->with('category')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('category_id', $category_id)
            ->groupBy('products.id', 'products.name', 'products.created_by', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderByRaw('average_rating DESC')
            ->get();

        return $products;
    }
}
