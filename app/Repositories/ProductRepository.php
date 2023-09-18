<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        $products = Product::with('category')->latest()->paginate(10);
        
        return ;
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
}
